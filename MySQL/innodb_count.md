# MySQLのInnodbでcountの実行速度を観る
## 概要
`MySQL` の `Innodb` の `COUNT` は、 `MyISAMに` 比べ、速度が遅いと言われています。  
普段の業務では、 `InnoDB` の `COUNT` が遅いとは感じていませんでしたが、その理由を知ることとなったので、まとめていきます。  

※[漢のコンピュータ道](http://nippondanji.blogspot.com/2010/03/innodbcount.html)に詳しい記事があります。

## TL;DR
* `InnoDB` の `COUNT` が早いと感じていたのは、 `index` を貼っていたフィールドを条件指定していたから
* 全件検索時にも、貼った `index` は適用される

## 内容
### 環境準備
まずは確認するにあたって、必要なテーブルとデータを用意します。  
テーブルは、 `index` の有無で速度が変わるかを確認するため、 `index` を貼ったフィールドと貼っていないフィールドの２つを用意します。  

```sql:テーブル作成
CREATE TABLE `add_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date1` date DEFAULT NULL COMMENT 'データ登録日時',
  `date2` date DEFAULT NULL COMMENT 'データ登録日時',
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'タイムスタンプ',
  PRIMARY KEY (`id`),
  KEY `index_date2` (`date2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
```

データの用意は、[こちら](https://qiita.com/juve_534/items/8e305b59e905189c46e2)に記事で作ったスクリプトを使います。  

```bash
$ go run execute.go
```

```sql
mysql> SELECT COUNT(*) FROM add_data;
+----------+
| COUNT(*) |
+----------+
|  3000000 |
+----------+
1 row in set (0.74 sec)
```

これで3,000,000件のデータが準備できました。  
これだけあれば、実行速度の差がわかるかなと思います。  

### 検証

まずは `WHERE` 句を使わずに、全件検索を試しました。
結果は1秒もかからずに返ってきました。

```sql
mysql> SELECT COUNT(*) FROM add_data;
+----------+
| COUNT(*) |
+----------+
|  3000000 |
+----------+
1 row in set (0.74 sec)
```

次は `index` を貼っていないフィールドを `WHERE` 句に設定します。
結果は1秒ほどかかり、全件検索よりもスピードが遅くなりました。

```sql
mysql> SELECT COUNT(*) FROM add_data WHERE date1='2018-08-09';
+----------+
| COUNT(*) |
+----------+
|    50000 |
+----------+
1 row in set (1.02 sec)
```

最後は `index` を貼っているフィールドを、 `WHERE` 句に設定します。
結果は瞬殺でデータが返ってきました。

```sql
mysql> SELECT COUNT(*) FROM add_data WHERE date2='2018-08-09';
+----------+
| COUNT(*) |
+----------+
|    50000 |
+----------+
1 row in set (0.05 sec)
```

このことから、 `index` を貼ると `InnoDB` の `COUNT` も早くなることがわかりました。

### 疑問
上記の結果をみると、全件検索の方が `index` を貼っていないフィールドを `WHERE` 句に設定した `SQL` より早くなっていることがわかります。  
データ量は明らかに `WHERE` 句を設定した方が多いのにも関わらずです。  
そこで、 `EXPLAIN` をとってみます。

```sql
mysql> EXPLAIN SELECT COUNT(*) FROM add_data;
+----+-------------+----------+------------+-------+---------------+-------------+---------+------+---------+----------+-------------+
| id | select_type | table    | partitions | type  | possible_keys | key         | key_len | ref  | rows    | filtered | Extra       |
+----+-------------+----------+------------+-------+---------------+-------------+---------+------+---------+----------+-------------+
|  1 | SIMPLE      | add_data | NULL       | index | NULL          | index_date2 | 4       | NULL | 2911434 |   100.00 | Using index |
+----+-------------+----------+------------+-------+---------------+-------------+---------+------+---------+----------+-------------+
1 row in set, 1 warning (0.00 sec)

mysql> EXPLAIN SELECT COUNT(*) FROM add_data WHERE date1='2018-08-09';
+----+-------------+----------+------------+------+---------------+------+---------+------+---------+----------+-------------+
| id | select_type | table    | partitions | type | possible_keys | key  | key_len | ref  | rows    | filtered | Extra       |
+----+-------------+----------+------------+------+---------------+------+---------+------+---------+----------+-------------+
|  1 | SIMPLE      | add_data | NULL       | ALL  | NULL          | NULL | NULL    | NULL | 2911434 |    10.00 | Using where |
+----+-------------+----------+------------+------+---------------+------+---------+------+---------+----------+-------------+
1 row in set, 1 warning (0.01 sec)
```

`index` を貼っていないフィールドを `WHERE` 句に設定した `SQL` は、当然 `index` が適用されないため、フルスキャンとなっています。  
対して全件検索は、 `index` を貼っているフィールドが適用され、少し早い結果となっていることがわかります。  

つまり。全件検索はテーブルのフィールドから、  `index` があるものを選定し利用していたため、 `index` を貼っていないフィールドを `WHERE` 句に設定したときより早くなっていました。

## まとめ
* `InnoDB` の `COUNT` も `index` を貼れば早くなる
* 全件検索時にも、貼った `index` は適用される
といえます。  

## 余談
`MyISAM` の実行結果は下記となり、 `InnoDB` に比べると早いことがわかります。
`InnoDB` も早くはなりましたが、餅は餅屋ということですかね。

```sql
mysql> SELECT COUNT(*) FROM add_data_myisam;
+----------+
| COUNT(*) |
+----------+
|  3000000 |
+----------+
1 row in set (0.00 sec)

mysql> SELECT COUNT(*) FROM add_data_myisam WHERE date1='2018-08-09';
+----------+
| COUNT(*) |
+----------+
|    50000 |
+----------+
1 row in set (0.26 sec)

mysql> 
mysql> SELECT COUNT(*) FROM add_data_myisam WHERE date2='2018-08-09';
+----------+
| COUNT(*) |
+----------+
|    50000 |
+----------+
1 row in set (0.02 sec)
```

なお。 `MyISAM` の `COUNT` が早いのは `COUNT(*)` の場合で、フィールドを指定した場合は、その限りではないようです。

以上で本記事は終了です。
最後まで読んで頂きありがとうございました。

## 参考資料
* [漢(オトコ)のコンピュータ道: InnoDBでCOUNT()を扱う際の注意事項あれこれ。](http://nippondanji.blogspot.com/2010/03/innodbcount.html)
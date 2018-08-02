
## 概要
MySQLのtimestamp型は[2038年問題](https://ja.wikipedia.org/wiki/2038%E5%B9%B4%E5%95%8F%E9%A1%8C)が発生すると聞きました。
自分たちは結構ガッツリtimestamp型を使っているので、動作を確認していきます。

対象はMySQL5.6です。

## TL;DR
* timestamp型は2038年問題に直面する
* 対策としては、DATETIME型にするかINT型でタイムスタンプを管理するか
    * DATETIME型にはタイムゾーンの概念がない

### 動作確認

まずは適当なテーブルを作成し、データを登録していきます。

```sql:date.sql
CREATE TABLE `date` (
  `date` datetime DEFAULT NULL COMMENT 'データ登録日時',
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'タイムスタンプ'
) ENGINE=InnoDB DEFAULT CHARSET=ujis
```

次に2038年問題が発生するギリギリのデータを登録してみます。
この時点ではどちらも正しく登録されております。

```sql
mysql> INSERT INTO date(date, stamp) VALUES ('2038-01-19 12:14:07', '2038-01-19 12:14:07');
Query OK, 1 row affected (0.00 sec)

mysql> SELECT * FROM date;
+---------------------+---------------------+
| date                | stamp               |
+---------------------+---------------------+
| 2038-01-19 12:14:07 | 2038-01-19 12:14:07 |
+---------------------+---------------------+
1 row in set (0.00 sec)
```

次に1秒加算した値を登録してみます。
するとtimestamp型はZeroDateになりました。

```sql
mysql> INSERT INTO date(date, stamp) VALUES ('2038-01-19 12:14:08', '2038-01-19 12:14:08');
Query OK, 1 row affected, 1 warning (0.00 sec)

mysql> SELECT * FROM date;
+---------------------+---------------------+
| date                | stamp               |
+---------------------+---------------------+
| 2038-01-19 12:14:07 | 2038-01-19 12:14:07 |
| 2038-01-19 12:14:08 | 0000-00-00 00:00:00 |
+---------------------+---------------------+
2 rows in set (0.00 sec)
```

そのため、 `2038-01-19 12:14:07`を超えると、stamp型のフィールドは正しい値が入力されなくなります…。
※STRICT_TRANS_TABLESを設定していると、Insertに失敗します。

## 対策

### 1. DATETIME型に変更する
DATETIME型が影響を受けないことは、上記で確認ができているので、一つの選択肢となりえます。

### 課題
DATETIME型は、タイムゾーンの影響を受けません。
そのため、タイムゾーンがUTC→JSTに切り替えても同じ値が入り、日付データが絶対値とならない可能性があります。
下記を見てもらうと、タイムゾーンが変わった後も、 `date` の値が変わっていないことがわかると思います。

```sql
mysql> SELECT * FROM date;
+---------------------+---------------------+
| date                | stamp               |
+---------------------+---------------------+
| 2038-01-19 12:14:07 | 2038-01-19 12:14:07 |
| 2038-01-19 12:14:08 | 0000-00-00 00:00:00 |
+---------------------+---------------------+
2 rows in set (0.01 sec)

mysql> set time_zone = '+00:00';
Query OK, 0 rows affected (0.00 sec)

mysql> SELECT * FROM date;
+---------------------+---------------------+
| date                | stamp               |
+---------------------+---------------------+
| 2038-01-19 12:14:07 | 2038-01-19 03:14:07 |
| 2038-01-19 12:14:08 | 0000-00-00 00:00:00 |
+---------------------+---------------------+
2 rows in set (0.00 sec)
```

### 2. INT型にタイムスタンプの絶対値を入れるようにする
INT型にしてタイムスタンプの値を入れてしまう案です。
これなら、DATETIME型で起きる問題は解決されます。

```sql
mysql> INSERT INTO date(date, stamp,unix_timestamp) VALUES ('2038-01-19 12:14:07', '2038-01-19 12:14:07', unix_timestamp('2038-01-19 12:14:07'));
Query OK, 1 row affected (0.00 sec)

mysql> SELECT *,from_unixtime(unix_timestamp) FROM date;
+---------------------+---------------------+----------------+-------------------------------+
| date                | stamp               | unix_timestamp | from_unixtime(unix_timestamp) |
+---------------------+---------------------+----------------+-------------------------------+
| 2038-01-19 12:14:07 | 2038-01-19 12:14:07 |     2147483647 | 2038-01-19 12:14:07           |
+---------------------+---------------------+----------------+-------------------------------+
1 row in set (0.00 sec)

mysql> set time_zone = '+00:00';
Query OK, 0 rows affected (0.00 sec)

// from_unixtime(unix_timestamp)　の値はタイムゾーンの値になっている
mysql> SELECT *,from_unixtime(unix_timestamp) FROM date;
+---------------------+---------------------+----------------+-------------------------------+
| date                | stamp               | unix_timestamp | from_unixtime(unix_timestamp) |
+---------------------+---------------------+----------------+-------------------------------+
| 2038-01-19 12:14:07 | 2038-01-19 03:14:07 |     2147483647 | 2038-01-19 03:14:07           |
+---------------------+---------------------+----------------+-------------------------------+
1 row in set (0.00 sec)
```
 

## 結論
MySQLのタイムスタンプ型は2038年問題が起きるので、利用は控えていった方が良さそう。
タイムゾーンの変更ない場合は、DATETIME型でも良さそうだが、絶対値とするならUNIXタイムスタンプの値を保持したほうが良さそう。

## 参考
* [【2038年問題】TIMESTAMP型の最大値は2038-01-09 03:14:07(UTC)【気をつけろ】](https://qiita.com/amymd/items/f92e5b7a6f4ab88ae62a)
* [MySQLのDATETIME型とTIMESTAMP型のタイムゾーン的な違いの話+O/Rマッパーのタイムゾーンの挙動の話](https://qiita.com/ryokkkke/items/a007d5edd4d8e7484c56)
* [MySQL :: MySQL 5.6 リファレンスマニュアル :: 11.3.1 DATE、DATETIME、および TIMESTAMP 型](https://dev.mysql.com/doc/refman/5.6/ja/datetime.html)
* [MySQL :: MySQL 8.0 Reference Manual :: 11.3.1 The DATE, DATETIME, and TIMESTAMP Types](https://dev.mysql.com/doc/refman/8.0/en/datetime.html)

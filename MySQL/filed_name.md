# MySQLのフィールドに予約語を設定する方法
## 概要
MySQLのフィールドに予約語を設定する方法について情報をまとめてみます。  
```
MySQLのフィールドには普通の方法では予約語を使えない = 使ってほしくないという意図があると考えられます。
あまり良い方法ではないので、使用するときは要注意です。
```

 ## 対応方法
 フィールド名を引用符「`」で囲むことで、フィールド名に利用することができます。  
 ```sql
 CREATE TABLE `test` (
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '識別ID',
  `register_date` datetime COMMENT '登録日時',
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'タイムスタンプ',
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=ujis COMMENT='TESTテーブル';
```

またこの場合はSQL実行時にもフィールド名に引用符をつける必要があります。  
```sql
// 引用符がないとき
mysql> INSERT INTO test(key, register_date) VALUES ('api_a34b5e7ba87c459c1053370e6e7a63b7', NOW());
ERROR 1064 (42000): You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'key, register_date) VALUES ('api_a34b5e7ba87c459c1053370e6e7a63b7', NOW())' at line 1


// 引用符があるとき
mysql> INSERT INTO test(`key`, register_date) VALUES ('api_a34b5e7ba87c459c1053370e6e7a63b7', NOW());
Query OK, 1 row affected (0.13 sec)

// WHERE句にも引用符が必要
mysql> SELECT * FROM test WHERE `key` = 'api_a34b5e7ba87c459c1053370e6e7a63b7';
+--------------------------------------+---------------------+---------------------+
| key                                  | register_date       | stamp               |
+--------------------------------------+---------------------+---------------------+
| api_a34b5e7ba87c459c1053370e6e7a63b7 | 2017-11-08 17:32:10 | 2017-11-08 17:32:10 |
+--------------------------------------+---------------------+---------------------+
1 row in set (0.00 sec)
```

これで予約語もフィールド名に設定して、動作させることができました。  
ここまで読んで頂き、ありがとうございました。

## 参考資料
* MySQL :: MySQL 5.6 リファレンスマニュアル :: 9.3 予約語
https://dev.mysql.com/doc/refman/5.6/ja/reserved-words.html
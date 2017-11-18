# MongoDB学習

## 用語説明
```
Database   = DB
Collection = RDBのテーブル相当
Docoument  = RDBのレコード相当
```
## 基本操作

### DB一覧取得
```
show dbs
```

### db内で利用できるメソッド表示
```
db.help
```

### オブジェクト名に登録されている値を取得
```
db.コレクション名.distinct(オブジェクト名)
```
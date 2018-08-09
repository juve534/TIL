# ローカルのMongoDBを2系から4.0にアップデートする
## 概要
MongoDBの4.0が[リリース](https://dev.classmethod.jp/server-side/db/introducing-mongodb-4/)され、トランザクションがサポートされるようになりました。  
ローカルの開発環境で試そうと思いましたが、バージョン2系がインストールされていたので、まずは4.0にアップデートしていきます。

## 手順
手順としては下記になります。

1. 動いているmongodbの停止
2. バックアップの取得
3. 既存バージョンの削除
4. 3系へのアップデート
5. 4系へのアップデート

一気に4.0へアップデートさせようとしたところ、起動時にエラーが発生しました。
ログを確認してみると、3.6を経由する必要があると読み取れたため、まずは3.6を目指して順番にアップデートしてから、4.0にします。

```
UPGRADE PROBLEM: The data files need to be fully upgraded to version 3.6 before attempting an upgrade to 4.0
```

ちなみに現在のバージョンは下記です。

```
$ mongo
MongoDB shell version: 2.6.12
```

### 1. 動いているmongodbの停止

```
service mongod stop
```

### 2. バックアップの取得

```
mkdir ~/mongo_dump
mongodump -v --dbpath /var/lib/mongo --out ~/mongo_dump/
```

### 3. 既存バージョンの削除

```
yum remove mongo-org*
yum list installed | grep mongo
```

### 4. 3系のインストール

#### 3.xのインストール
##### repo用意

```:/etc/yum.repos.d/mongodb-org-3.x.repo
[mongodb-org-3.x]
name=MongoDB Repository
baseurl=https://repo.mongodb.org/yum/redhat/$releasever/mongodb-org/3.x/x86_64/
gpgcheck=0
enabled=1
```

##### インストール実施

```
yum install -y mongodb-org-3.x
```

##### 立ち上げ

```
service mongod start
```

##### 停止

```
service mongod stop
```

##### 削除

```
yum remove -y mongo-org*
```

#### 3.2のインストール
##### repo用意

```:/etc/yum.repos.d/mongodb-org-3.2.repo
[mongodb-org-3.2]
name=MongoDB Repository
baseurl=https://repo.mongodb.org/yum/redhat/$releasever/mongodb-org/3.2/x86_64/
gpgcheck=0
enabled=1
gpgkey=https://www.mongodb.org/static/pgp/server-3.2.asc
```

##### インストール実施

```
yum install -y mongodb-org-3.2.20 mongodb-org-server-3.2.20 mongodb-org-shell-3.2.20 mongodb-org-mongos-3.2.20 mongodb-org-tools-3.2.20
```

##### 立ち上げ

```
service mongod start
```

##### 停止

```
service mongod stop
```

##### 削除

```
yum remove mongo-org*
```

```
yum install -y mongodb-org-3.6.6 mongodb-org-server-3.6.6 mongodb-org-shell-3.6.6 mongodb-org-mongos-3.6.6 mongodb-org-tools-3.6.6
```

#### 3.4→3.6のときの対応

3.4から3.6にアップデートするときも下記のエラーが発生しました。  

```
UPGRADE PROBLEM: The data files need to be fully upgraded to version 3.4 before attempting an upgrade to 3.6; see http://dochub.mongodb.org/core/3.6-upgrade-fcv for more details.
```

リンク先に飛んでみるとコマンドの実行を求められたので、コマンドを実行します。

```
// バージョンの確認
> db.adminCommand( { getParameter: 1, featureCompatibilityVersion: 1 } )
{ "featureCompatibilityVersion" : "3.2", "ok" : 1 }

// バージョンの変更
> db.adminCommand( { setFeatureCompatibilityVersion: "3.4" } )
```

このコマンドは3.6→4.0でも使うので覚えておくようにしましょう。

#### 4系のインストール

[公式の手順](https://docs.mongodb.com/master/tutorial/install-mongodb-on-red-hat/)に従ってインストールしていきます。

##### repo用意

```:/etc/yum.repos.d/mongodb-org-3.2.repo
[mongodb-org-4.0]
name=MongoDB Repository
baseurl=https://repo.mongodb.org/yum/redhat/$releasever/mongodb-org/4.0/x86_64/
gpgcheck=1
enabled=1
gpgkey=https://www.mongodb.org/static/pgp/server-4.0.asc
```

##### インストール実施

```
yum install -y mongodb-org-4.0.0 mongodb-org-server-4.0.0 mongodb-org-shell-4.0.0 mongodb-org-mongos-4.0.0 mongodb-org-tools-4.0.0
```

##### 立ち上げ

```
service mongod start
```

##### 起動確認

```
$ mongo
MongoDB shell version v4.0.0
connecting to: mongodb://127.0.0.1:27017
MongoDB server version: 4.0.0
```

これでインストールができました。
データの破損も見受けられなかったので、アップデートも問題なさそうです。

最後まで読んで頂きありがとうございました。

## 参考資料
* [Install MongoDB Community Edition on Red Hat Enterprise or CentOS Linux — MongoDB Manual](https://docs.mongodb.com/master/tutorial/install-mongodb-on-red-hat/)
* [MongoDBがダウンするようになったので、v2.4.5からv3.0にアップデートした話](https://webmake.info/mongodb%E3%81%8C%E3%83%80%E3%82%A6%E3%83%B3%E3%81%99%E3%82%8B%E3%82%88%E3%81%86%E3%81%AB%E3%81%AA%E3%81%A3%E3%81%9F%E3%81%AE%E3%81%A7%E3%80%81v2-4-5%E3%81%8B%E3%82%89v3-0%E3%81%AB%E3%82%A2%E3%83%83/)

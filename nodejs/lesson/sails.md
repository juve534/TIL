# Sails.js
## 概要
RailsライクなNode.jsのフレームワークです。    

## 導入
```
npm install sails -g
```

## プロジェクトの作成
下記コマンドでプロジェクトの作成とサーバ立ち上げが完了します。  
実行後は、http://IP:1337 にアクセスし、ページが表示されるか確認して下さい。
```
sails new sails-tutorial
cd sails-tutorial
sails lift
```
![ホームページ](img/homePage.png)

## コントローラーの生成
Controllerとメソッドの生成は下記コマンドで行います。
```
sails generate controller コントローラー名 メソッド名
```

## モデルの作成
モデルもコントローラーと同様にコマンドで作成できます。  
作成時にはフィールドの方指定も可能です。  
```
sails generate model モデル名 フィールド名:型 フィールド名:型
```

## Hello, World
ApplicationControllerとhelloメソッドを生成し、ブラウザに「Hello, World」を出力してみます。
```
sails generate controller application hello
```

```
/**
 * ApplicationController
 *
 * @description :: Server-side logic for managing applications
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {
  /**
   * `ApplicationController.hello()`
   */
  hello: function (req, res) {
    return res.send('Hello, World!');
  }
};
```

コントローラーに処理を記載しましたら、ルーティングの設定を行います。
```
module.exports.routes = {
  '/': {
    view: 'homepage',
  },
  '/hello': 'ApplicationController.hello'
};
```
これで、http://IP:1337/hello にアクセスすると、ページに「Hello, World」が表示されます。

なお、Sails.jsではモデルに対応する同名のコントローラーが存在すれば、自動でルーティングをしてくるようになります。
例). UserモデルとUserコントローラーがあれば、http://IP:1337/user でアクセス可能となる。

## データベースの設定
Sails.jsでは、sails-diskを利用することで、ローカルにデータベースを構築することが出来ます。  
またマイグレーションの設定を行うことで、 ```sails lift```実行時に自動でマイグレーションしてくれます。
```
module.exports.models = {
  migrate: 'alter',
  connection: 'localDiskDb',
};
```

## 参考資料
https://qiita.com/t-yng/items/73989826229da0463c41
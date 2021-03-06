# npm
## 概要
「Node.js？サーバサイドのJSってどういうこと？」と全然分かっていなかったPHPerが、自分用に npm について学習したことをまとめていきます。

## npmとは
Node Package Managerの略で、Node.jsのパッケージ管理ツールとなります。  
基本 Node.js をインストールすれば一緒にインストールされ、PHPのComposerに相当します。  

## 使い方
### バージョン確認
まずは基本ということで npm のバージョン確認。
```
npm -v
```

### パッケージのインストール
コマンド一発でインストールできます。  
グローバルインストールとカレントディレクトリへのインストールは、状況によって使い分けてみてください。  
個人的には、Gitなどでバージョン管理するならカレントディレクトリの方が良いかなと思います。
```
// カレントディレクトリにパッケージインストール
npm install パッケージ名

// グローバルにパッケージインストール
npm install -g パッケージ名
```

### パッケージのアンインストール
パッケージのアンインストールはインストールとほぼ同様です。
```
// カレントディレクトリのパッケージをアンインストール
npm uninstall パッケージ名

// グローバルのパッケージをアンインストール
npm uninstall -g パッケージ名
```

### インストール済のパッケージのリストを表示
インストール済のパッケージのリストを表示するには 下記のコマンドを実行します.
```
// カレントディレクトリのパッケージ一覧を表示
npm list

// グローバルのパッケージ一覧を表示
npm list -g
```

### パッケージの情報を表示する
npm に登録されているパッケージの情報を得るには
下記のコマンドを実行します.
```
npm info パッケージ名
```

## 実用編
### package.json
npm は package.json という名前のファイルを作り、依存関係を管理することができます。

### package.json を作る
下記のコマンドを実行すると対話式でpackage.json を作ることが出来ます。
```
npm init
```
次にインストールしたいパッケージを下記コマンドでインストールします。
```
npm install パッケージ名 --save-dev
```
これでパッケージに依存関係のあるパッケージも合わせて管理することが出来ます。  
package.jsonを利用して、パッケージをインストールする場合は下記を実行します。
```
npm uninstall
```
これで依存関係のあるパッケージごとインストールしてくれます。

### package.json にオリジナルコマンドを追加
package.jsonもComposerと同様に、オリジナルコマンドを実行するように設定することが出来ます。  
オリジナルコマンドとカッコつけましたが、単にShellコマンドを登録するだけですね。
Shellはpackage.jsonのscriptsに追記することで、登録できます。
```
"scripts": {
    "test": "echo \"Error: no test specified\" && exit 1",
    "hello": "echo \"Hello World!\""
  },
```
追加したコマンドはターミナル上で実行できます。

```
npm run hello
```

またnpm run実行時に引数を渡すことが出来ます。  
引数を渡す際は下記となります。
```
npm run コマンド名 -- 引数
```

## 参考資料
http://phiary.me/node-js-package-manager-npm-usage/
https://qiita.com/tiny-studio/items/ce28bf84c76aba53122f
# dietcake

## 概要
dietcakeはPHPで作られたフレームワークとなります。  
CakePHPのようなPHPのMVCフレームに多くある、ディレクトリ構造で開発する事を想定しています。  
軽量フレームワークとフルスタックフレームワークの間のようなデザインになっています。

## 特徴

* 高速動作
* 低学習コスト
* 自由にカスタマイズできる

## 導入
導入はcomposerから行えます。
いくつか雛形のインストールができ、今回はspongecakeという雛形をインストールします。

```
 composer create-project dietcake/spongecake dietcake
```

インストールが完了しましたら、次はcore.phpの作成を行います。  
core.phpにはDBのパスワードといった機微情報を記載するため、インストールした時点ではファイルが存在しません。  
そのため、core.development.phpというファイルをコピーし作成します。

```
$ cd dietcake
$ cp app/config/core.development.php app/config/core.php
```

これで導入完了です。

## ブラウザから確認
では、実際にブラウザ上でアクセスして動作確認を行います。  
今回はてっとり早くPHPのビルドインサーバで確認します。

```
$ cd dietcake/app/webroot
$ php -S IP:8088
```

あとはブラウザ上でアクセスし、下記のページが表示されれば諸々完了です。
![デフォルトページ](default_page.png)

## 参考資料
spongecake で hello world
https://project-p.jp/halt/2014/12/03/102428/
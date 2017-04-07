# 初めてのPHPのマイクロフレームワーク「Slim」
## 概要
PHPでAPIを作成するならどのモジュールが良いかを検討する過程で、
PHPのマイクロフレームワーク「Slim」の存在を知りました。
そこで、使用感の確認がてらSlimを触っていきます。

## インストール
composerでインストール可能です。
インストールは公式サイトのチュートリアルを参考に下記で行います。

```
php composer.phar create-project slim/slim-skeleton アプリケーション名
```
アプリケーション名のディレクトリが作成されましたら、
アプリケーション名/publicをドキュメントルートに設定してブラウザよりアクセスします。

すると下記の画面が表示されるかと思います。

<img width="1057" alt="スクリーンショット 2017-03-09 1.09.36.png" src="https://qiita-image-store.s3.amazonaws.com/0/39671/2cb695f4-7963-45c8-5ebd-cc7973b02049.png">

これで一先は開発準備完了です。

## ルーティングの確認
Slimeではルーティング情報はroutes.phpに記載されています。
インストール時点では、getでルート/文字と入力すると「Hellow 文字」と出力する設定が記載されています。

```src/routes.php
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
```

実際にブラウザで「ルート/world」でアクセスしてみると下記のページが表示されます。
<img width="986" alt="スクリーンショット 2017-03-09 2.23.55.png" src="https://qiita-image-store.s3.amazonaws.com/0/39671/6ba4e8c8-3429-4927-a8bf-611e06d13b01.png">

これでざっくり動作は確認できたので、引き続いて触っていきます。

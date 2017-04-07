# PHPフレームワーク「Slim」でMySQLを利用してみる

## 概要
[前回の記事](http://qiita.com/juve_534/items/79877a0cf0b0b6b8298c)に引き続いてSlimを触っていきます。

今回はMySQLに接続してDBからデータを取得していきます。

## 設定
まずは[公式サイトのドキュメント](https://www.slimframework.com/docs/tutorial/first-app.html)を参考にし、DSN情報をsetting.phpに記載します。

```src/setting.php
// db接続情報
'db' => [
    'host'   => 'localhost',
    'user'   => 'ユーザ名',
    'pass'   => 'パスワード',
    'dbname' => 'DB名',
]
```

次に、DBオブジェクト生成を行います。
今回はチュートリアルと同様にPDOを利用します。

```src/dependencies.php
// DB接続
$container['db'] = function ($c) {
    $dsn = 'mysql:host=%s;dbname=%s;charset=utf8mb4'
    $db  = $c['settings']['db'];
    $pdo = new PDO(sprintf($dsn, $db['host'], $db['dbname']),
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
```
これで準備は整いました。
それでは実際にDBからデータを取得していきます。

## データ取得
今回はブログの件名と登録内容を格納したpostsテーブルからデータを取得していきます。

先程生成したDBオブジェクトは、routes.php内で$this->dbとして利用することが出来ます。

```src/routes.php
// ブログ登録内容取得
$app->get('/blog', function ($request, $response, $args) {

    $sql = 'SELECT * FROM posts';
    $query = $this->db->prepare($sql);
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    var_dump($data);
});
```

実際にブラウザからアクセスすると下記のようにデータが取得できていました。

```
array
  0 =>
    array
      'id' => string '1'
      'title' => string '???'
      'body' => string '???lol'
      'created' => string '2016-03-03 01:49:06'
      'modify' => string '2016-03-11 02:25:00'
```

なぜかマルチバイトが文字化けしていますが、データ取得自体は出来たので今回はここまでとします。

## 追記
マルチバイトの文字化けはコメントにてご指摘頂いたようにcharsetの指定漏れでした。
ちゃんとcharsetを指定することで文字化けは解消されました。

```
array
  0 =>
    array
      'id' => string '1'
      'title' => string 'テスト'
      'body' => string 'テストlol'
      'created' => string '2016-03-03 01:49:06'
      'modify' => string '2016-03-11 02:25:00'
```

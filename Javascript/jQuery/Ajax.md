# Ajax
## Ajax処理完了後に処理を実行する
Ajaxは非同期通信のため、通信中にも次の処理を実行してしまう。
しかし、Ajaxで実行した結果を基に処理を行いたい場合もあるだろう。
その際はコールバックを利用して、実行した結果を受け取って処理をすすめると良い。

```
// ajaxを実行する関数
var メソッド名 = function(callback) {
  $.ajax({
    src: 'URL',
    dataType: 'json',
    success: function(data) {
      callback(data);
    }
  });
}
// Ajaxで取得したデータを基に処理を進める
メソッド名(function(userId) {
  ...
});
```
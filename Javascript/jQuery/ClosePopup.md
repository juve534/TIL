# 画面外clickでポップアップを閉じる

## 概要
画面外をクリックしたときにポップアップを閉じるってやつ、結構ありますし便利ですよね。
今回はそれを実装します。

## やること
documentまたは、id要素に対してクリックイベントが発生したときに、クリックした対象が該当DOM以外であれば閉じるようにする。

```javascript
$(document).on('click touchend', function(event) {
  if (!$(event.target).closest('#target').length) {
    // ここに処理;
    $('#target').hide('slow');
  }
});
```

## 参考
[範囲外クリックでポップアップを閉じる正しい JQuery](https://qiita.com/mabots/items/74c21ebcedf0004f7fb5)
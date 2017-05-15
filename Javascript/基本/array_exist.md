# 配列や連想配列のキーの存在チェック
array[1]やhash.aでも対応できるが、undefinedやnull、空文字のときにfalseとなるため、
下記のやり方を推奨。

```
//配列の場合
if (1 in array) {
    // ...
}

// 連想配列の場合
if ('a' in hash) {
    // ...
}
```
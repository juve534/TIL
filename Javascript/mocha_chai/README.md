# JavaScriptでテスト
## 概要
mochaとchaiを使ったJavaScriptのテストを学習します。  
事前にmochaとchaiを環境に入れておく必要があります。

## 導入
mochaとchaiはともにnpmを使ってインストールすることができます。
npmの使い方は[npmについて](https://github.com/juve534/TIL/blob/master/nodejs/lesson/npm.md)を参照してください。

```
npm install mocha --save
```

```
npm install chai --save
```

## テスト動かしてみる
mochaとchaiの導入が済んでいるので、簡単なプログラムを作成して、テストを動かしてみます。  
テスト対象のファイルとして、myfunc.jsを作成します。

```
/**
 * @classdesc 計算
 */
var myfunc = function () {
    /**
     *　プラス1する関数
     *
     * @param  [Integer] val 数値
     * @return [Integer]     プラス1した数
     */
    this.contract = function(val) {
        return val + 1;
    };
};

module.exports = myfunc;
```

次にテストケースを作成します。

```
//var assert = require('assert'); ←これでもいける
var chai   = require('chai');
var assert = chai.assert;

// テストスクリプトからの相対パスでrequire
var myfunc = require('./myfunc');

describe("myfunc", function(){
  it("加算成功", function() {
    var test = new myfunc();
    assert.equal(2, test.contract(1))
  }),
  it("nullを加算", function() {
    var test = new myfunc();
    assert.equal(1, test.contract(null))
  });
});
```

準備が整ったらテストを実行してみます。  
今回は特定のテストケースを実行してみるため、プログラムを指定して実行してみます。

```
$ mocha test.js


  myfunc
    ✓ 加算成功
    ✓ nullを加算


  2 passing (14ms)
```
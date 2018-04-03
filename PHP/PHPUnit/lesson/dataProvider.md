# dataProviderについて
## 概要
1つのテストケースに対して複数のパラメータを渡して動作させたいときがある。

例).特定の日付で動作させるプログラムのテスト

foreachでパラメータを渡すということもできるが、PHPUnitには dataProvider というもっと賢い機能があるので利用する。

## 実装方法
まずは dataProvider となるメソッドを用意する。

```
public function dataProvider()
{
    return array(
        array('2017-11-15'),
    );
}
```

これで準備はOK。あとはテストメソッドに下記を指定する。

```
/**
 * @dataProvider dataProvider
 */
public function testDataProvider($date)
{
}
```

これで $date には dataProvider で設定した日付が渡されます。
こうすることで、テストケースの冗長化を防ぎ、テストケースの可読性を上げることができます。

## 関連資料
https://phpunit.de/manual/current/ja/writing-tests-for-phpunit.html
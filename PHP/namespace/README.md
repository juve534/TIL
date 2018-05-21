# 名前空間について
## 概要
名前空間(namespace)について学習したことをまとめていく。

## 詳細
### 名前空間がない世界
PHPは同じ名前の関数が定義できない。  

```php:A.php
<?php
function getGreeting() {
    return 'おはよう';
}
```

```php:B.php
<?php
function getGreeting() {
    return 'おはよう';
}
```

```php:call.php
<?php
require_once 'A.php';
require_once 'B.php';

echo getGreeting();
```

これを実行すると `Fatal error` になります。

```
$ php call.php
PHP Fatal error:  Cannot redeclare getGreeting() (previously declared in TIL/PHP/namespace/A.php:3) in TIL/PHP/namespace/B.php on line 4

Fatal error: Cannot redeclare getGreeting() (previously declared in TIL/PHP/namespace/A.php:3) in TIL/PHP/namespace/B.php on line 4
```

これは同じ空間に同じ関数名があるために発生しています。  
別の関数名にすれば問題は解決できますが、定義する関数名が多くなって、 `メソッド名1` とかを生み出す懸念もあります。

### 名前空間がある世界
PHP5.3から名前空間が定義できるようになりました。  
この名前空間を定義することで、空間を分けることができ、同名関数を存在させることができます。  

```
namespace 定義名;
```

呼び出すときは、 `名前空間\メソッド名` として呼び出します。

```php:A.php
<?php
namespace A;

function getGreeting() {
    return 'おはよう' . PHP_EOL;
}
```

```php:B.php
<?php
namespace B;

function getGreeting() {
    return 'こんにちは' . PHP_EOL;
}

```

```php:call.php
<?php
require_once 'A.php';
require_once 'B.php';

echo A\getGreeting();
```

これを実行すると、 `おはよう` の文字が出力され、プログラムは正常に終了します。

```
$ php call.php
おはよう
```

これで名前空間を定義し、同名関数を存在させることができました。  

### サブ名前空間
名前空間は更に細かく定義することもできます。  

```php:Aa.php
<?php
namespace A\a;

function getGreeting()
{
    return 'こんばんは' . PHP_EOL;
}
```

呼び出す際は、定義した名前空間を記載します。

```php:call.php
<?php
require_once 'A.php';
require_once 'B.php';
require_once 'Aa.php';

echo A\a\getGreeting();
```

これで一階層深く名前空間を定義することができました。

## 参考資料

[【PHP超入門】名前空間（namespace・use）について](https://qiita.com/7968/items/1e5c61128fa495358c1f)
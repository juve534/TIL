# 日付変更処理の注意点

CarbonやDateTimeでは、指定されなかった部分が現在情報が使われ、稀にデータがずれることがある。

## 症状

```php
>>> Carbon::create(2018, 2)->lastOfMonth();
=> Carbon\Carbon @1522454400 {#2839
     date: 2018-03-31 00:00:00.0 UTC (+00:00),
   }

>>> DateTimeImmutable::createFromFormat('Y/m', '2018/02')
=> DateTimeImmutable @1519904173 {#2819
     date: 2018-03-01 11:36:13.0 UTC (+00:00),
   }
```

## 対策

1. 日付まで指定する
```php
Carbon::create(2018, 2, 1)
```
2. フォーマットを整える
```php
DateTime::createFromFormat('!ym', '1802')
```

## 備考
`DateTime::createFromFormat `の `!` や `|` はUNIXエポックにリセットすると書いてあるけど、試してみると実際には使用されるタイムゾーンにおける `1970-01-01 00:00:00` になる。
PHPマニュアルがまどろっこしいのでそこを注意する。
# Elixirについて勉強してみる
## 概要
バックエンドのプログラムの学習としてElixirを使ってアプリケーションを作って見ようと思います。  
そこで、Elixirについて勉強してみたことをまとめていきます。

## Elixirとは
ElixirはErlangのVM上で動作する関数型言語です。  
Elixirの特徴は以下となります。

* スケールしやすい
* 耐障害性が高い(フォールトトレラント)
* 関数型プログラミング
* 拡張しやすい

## 環境構築
Erlang関係のパッケージを導入

```
sudo yum install ncurses ncurses-devel openssl openssl-devel gcc-c++ unixODBC unixODBC-devel fop *openjdk-devel inotify-tools
```

作業ディレクトリ作成＆移動

```
mkdir work
cd work/
```

Erlangの最新コード(2017/01/14時点で19.2)をダウンロードして解凍

```
wget http://erlang.org/download/otp_src_19.2.tar.gz
tar -zxf otp_src_19.2.tar.gz
```

ビルド＆インストール

```
cd otp_src_19.1/
./configure
make
sudo make install
```

Erlangが入ったか確認

```
erl -version
```

Elixirのソースコードをダウンロード＆解凍（解凍は/opt/elixirに）

```
cd ..
wget https://github.com/elixir-lang/elixir/releases/download/v1.4.0/Precompiled.zip
sudo unzip Precompiled.zip -d /opt/elixir
```

PATHに追記して再起動

```
sudo vim ~/.bash_profile
   (以下追記)
   export PATH=/opt/elixir/bin:$PATH
sudo reboot
```

Elixirが入ったか確認

```
elixir -v
```

パッケージ管理ツールHexを標準ビルドツールmixでインストール

```
mix local.hex
```

WebフレームワークPhoenixをmixでインストール

```
mix archive.install https://github.com/phoenixframework/archives/raw/master/phoenix_new.ez
```

## インタラクティブモードで実行
Elixir をインストールすると，iex，elixir そして elixirc の 3 つのコマンドを実行出来るようになります。  
Elixirをインタラクティブモードで実行するコマンドは iex となりますので、
iexを実行してインタラクティブモードでElixirを触ってみます。

```Elixir
iex

Interactive Elixir (1.4.0) - press Ctrl+C to exit (type h() ENTER for help)
iex(1)> 40 + 2
42
iex(2)> "Hello World!"
"Hello World!"

// 終了する際は Ctrl+C を入力後に q
iex(3)> 
BREAK: (a)bort (c)ontinue (p)roc info (i)nfo (l)oaded
       (v)ersion (k)ill (D)b-tables (d)istribution
q 
```

## プログラムを実行
ターミナル上からプログラムを実行する際はiexコマンドを実行します。  
チュートリアルに沿って、Hello worldを出力するスクリプトを実行します。

```Elixir:simple.exs
IO.puts "Hello world
from Elixir"
```
```
$ elixir simple.exs
Hello world
from Elixir
```

## 基本
Elixirの環境構築が完了したので、次は基本を学習していきます。

### データ型
#### 数値型
2進数、8進数、16進数に対応している。

```Elixir
iex> 0b0110
6
iex> 0o644
420
iex> 0x1F
31
```
数値演算はPHPと同様に+, -, *, /で行います。
注意点としては、Elixirでは/を実行した際は常に浮動小数点を返すことです。

```Elixir
iex(1)> 1+1
2
iex(2)> 2-1
1
iex(3)> 10*2
20
iex(4)> 10/2 ← 実行結果が浮動小数点となっている
5.0
```

#### 浮動小数点

```Elixir
iex> 3.14 
3.14
```

#### 真理値
Elixirでは真理値としてtrueとfalseを使えます。  
またbooleanかどうかを判定する関数としてis_booleanが用意されています。

```Elixir
iex> true
true
iex> is_boolean(true)
true
```

#### アトム
アトムは名前が自身の値を表わしている定数でRubyではシンブルと呼ばれています。

```Elixir
iex> :hello
:hello
```

#### 文字列
Elixirの文字列は二重引用符の中に書き，UTF-8でエンコードされます。
またPHPの用に展開も可能です。

```Elixir
iex> "hellö"
"hellö"
iex> "hellö #{:world}" 
"hellö world"
```

文字列の結合は<>で行います。

```Elixir
iex> "apple" <> "pen"
"applepen"
```

#### リスト
リストはPHPに置ける配列のような形式でデータを格納する型です。

```Elixir
iex> ["apple", "pen", "Pineapple", "pen"]
["apple", "pen", "Pineapple", "pen"]
```

PHP同様に多次元化することも可能です。

```Elixir
iex> [["apple", "pen", "Pineapple", "pen"], ["暗い", "明るい"]]
[["apple", "pen", "Pineapple", "pen"], ["暗い", "明るい"]]
```

リストのデータは加算・減算することが出来ます。

```Elixir
iex> ["apple", "pen"] ++ ["Pineapple", "pen"]
["apple", "pen", "Pineapple", "pen"]
iex> ["apple", "pen"] -- ["Pineapple", "pen"]
["apple"]
```

またリストのデータを取得する組み込む関数もあります。

```Elixir
iex> hd ["apple", "pen", "Pineapple", "pen"] ← 最初の要素を取得
"apple"
iex> tl ["apple", "pen", "Pineapple", "pen"] ← 最初の要素以外を取得
["pen", "Pineapple", "pen"]
iex> Enum.at ["apple", "pen", "Pineapple", "pen"], 2 ← 指定したKEYの値を取得
"Pineapple"
```

#### タプル
リストと同様に順序付けられた集合帯ですが、
リストは飛び飛びのメモリ領域を結びつけてるけど、タプルは連続したメモリ領域を確保するため、ランダムアクセスに向いています。

データの取得は主にelemを利用するようです。

```Elixir
iex> elem {"apple", "pen", "Pineapple", "pen"}, 1   
"pen"
```

ただしリストに比べると中身の変更には一手間必要です。

```Elixir
iex> Tuple.delete_at {"apple", "pen", "Pineapple", "pen"}, 1 
{"apple", "Pineapple", "pen"}

iex> put_elem {"暗い", "明るい"}, 1, "とんとん"
{"暗い", "とんとん"}
```
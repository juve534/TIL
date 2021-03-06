# 代理キー(サロゲートキー)とはなんぞや
## 概要
身の回りで話題になる `代理キー(サロゲートキー)` という言葉をよく耳にします。    
意味合いをわかっていないので、勉強していきます。

## 代理キー(surrogate key)
>業務上は意味を持つ値ではないが、システム的に一意な値をとるようオートインクリメントなどで連番を振り、PKとしているテーブルのPKのことをサロゲートキー（代理キー）と呼びます。
>出展 : https://amg-solution.jp/blog/8980

例としては `id` と呼ばれるものになります。  
ピンときづらいと思うので、対義語を考えます。  

対義語は自然キー(ナチュラルキー)となります。  
例えば、ログイン用のテーブルがある場合、ログイン用のIDは一意である必要があると思います。  
その場合、ログイン用のIDは意味のある値となるため、ナチュラルキーに相当します。  

対して、名前・電話番号・メールアドレスを格納するテーブルを作ったとします。    
この場合、名前も電話番号もメールアドレスも完全に一意の値ではありません。  
仮に複合インデックスにしたとしても、一意の値と言えるかは怪しいところかと思います。  
(電話番号は変更が予想される…etc)  
このようなテーブルの場合は、サロゲートキーのように機械的な番号を割り振ることは有効です。  

また、最近ではRuby on RailsのようなFWで、マイグレーションした場合、自動的に追加されたりします。

## SQLアンチパターン
[SQLアンチパターン](https://www.oreilly.co.jp/books/9784873115894/)の3章で、サロゲートキーについて触れています。  

ここでは、思考停止でサロゲートキーを振らず、少し考えた方が良いということが書かれています。  

例えば、何らかの意図を持って、ユーザ固有のユニークIDを作成したとします。  
この場合、このユニークIDを主キーにすれば良いため、サロゲートキーを振る必要はありません。  
ユニークIDの方が、単純なIDよりわかりやすいことも、上記判断の助けとなります。  

## まとめ
* サロゲートキーは、業務上は意味のある値ではないが、システム的に一意の値を設定するために使われます
* ORMは自動で生成してくれます
* 場合によってはサロゲートキーより、主キーに適切なキーが有ることがあります

内容は以上となります。  
最後まで読んで頂きありがとうございました。

## 参考資料
* [SQLアンチパターン](https://www.oreilly.co.jp/books/9784873115894/)
* [DB設計について考えてみた。ナチュラルキーとサロゲートキーはどちらが良いのか？](https://amg-solution.jp/blog/8980)
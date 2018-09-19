# Phoenix
## 概要
Phoenixの使い方をメモする。  

## 使い方
### 依存性の解決

```Bash
mix deps.get
```

### APIとDBを作成する

雛形となるJSONレスポンス用のController, View, Contextを作成してくれます。

```Bash
mix phx.gen.json

$ mix phx.gen.json Blog Article articles title:string body:text
```

### テストを実行する

```Bash
$ mix test ファイル名
$ mix test test/elixir_blog/blog/blog_test.exs
```
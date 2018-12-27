# Elasticsearch
## 概要
* Javaで作られた分散処理型の検索エンジン
* クラスタ構成を組める
* 下記で使われがち
   * リアルタイムデータ分析
   * ログ解析
   * 全文検索
* 構築方法も複数あり
   * オンプレで構築
   * AWSを使う
   * Elastic社のクラウドを利用

## 環境構築
### Docker
公式がDockerイメージを提供しているので、それを利用する。  
2018/12/05現在は6.5.1が最新。

```
$ docker pull docker.elastic.co/elasticsearch/elasticsearch:6.5.1
```

#### 注意点
バージョン指定がないとインストールができない。  
必ずバージョンを指定すること。
```
$ docker pull elasticsearch
Using default tag: latest
Error response from daemon: manifest for elasticsearch:latest not found
```
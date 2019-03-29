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

## 実行

```
$ docker run -p 9200:9200 -p 9300:9300 -e "discovery.type=single-node" -e "network.publish_host=localhost" -v "plugins:/usr/share/elasticsearh/plugins" docker.elastic.co/elasticsearch/elasticsearch:6.5.1

$ curl http://localhost:9200
{
  "name" : "6M-hBAk",
  "cluster_name" : "docker-cluster",
  "cluster_uuid" : "5SKANwC6RX6FPBbcsl8Vqw",
  "version" : {
    "number" : "6.5.1",
    "build_flavor" : "default",
    "build_type" : "tar",
    "build_hash" : "8c58350",
    "build_date" : "2018-11-16T02:22:42.182257Z",
    "build_snapshot" : false,
    "lucene_version" : "7.5.0",
    "minimum_wire_compatibility_version" : "5.6.0",
    "minimum_index_compatibility_version" : "5.0.0"
  },
  "tagline" : "You Know, for Search"
}
```

| パラメータ | 意味 | 例 |
|:-----------:|:------------:|:------------:|
| discovery.type | ノード構成 | single-node |
| network.publish_host | APIのエンドポイントとして公開するIP | localhost |
| plugins | プラグインのディレクトリ | /usr/share/elasticsearh/plugins |

## 操作
### INDEXの追加
`mapping.json` に投入する `INDEX` を用意し、下記コマンドを実行します。
```
$ curl -XPUT http://localhost:9200/chat -H "Content-Type: application/json" -d @mapping.json
{"acknowledged":true,"shards_acknowledged":true,"index":"chat"}
```

実行が完了したらデータを取得してみます。

```
$ curl -XGET 'http://localhost:9200/chat/_mapping/chat?pretty'
{
  "chat" : {
    "mappings" : {
      "chat" : {
        "properties" : {
          "created" : {
            "type" : "date"
          },
          "message" : {
            "type" : "text"
          },
          "tag" : {
            "type" : "keyword"
          },
          "user" : {
            "type" : "text"
          }
        }
      }
    }
  }
}
```

### Go言語から実行
#### HelloWorld

1.Go言語からElasticsearchを操作します  
操作用にライブラリを入れます。
```bash
go get github.com/olivere/elasti
```
2.[コード](./code/hello_elasticsearch.go)を実装します  
3.コードを実行すると、Elasticsearchの数値が表示されます
```
$ go run Elasticsearch/code/hello_elasticsearch.go
Elasticsearch version 6.5.1
```
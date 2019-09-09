# Docker :whale:
## 概要
Dockerについて学んだことをまとめていく。

## Docker概要

* Docker Index
* * Dockerのイメージ共有サイト 
* Image
* * コンテナのもとになるもの
→Vagrant boxみたいなもの
* Container
* * 仮想環境

## 操作

### イメージの検索

```bash
docker search 検索ワード
ex. docker search centos
```

### イメージの取得

```bash
// 最新バージョン取得
docker pull 名前
```

### イメージの削除

```bash
docker rmi イメージID
```

### コンテナの確認

```bash
// 実行中コンテナの確認
docker ps

// コンテナを全部表示
docker ps -a

// コンテナの数を指定して表示
docker ps -a -n=数値
```

### コンテナの実行

```bash
// スクリプト実行
docker run centos echo "hello world"
```

### Dockerfileの操作
自分でコンテナイメージを作ることができる。  
その操作をまとめる。  

#### ビルド

```bash
docker build -t 名前 ./
```

#### ディレクトリを指定してssh

```bash
docker run -v `ローカル`:リモート -it 名前 bash
ex.) docker run -v `pwd`:/root/workspace -it centos bash
```
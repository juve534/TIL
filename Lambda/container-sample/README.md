# Lambdaでコンテナを動かすサンプル

## 概要

[AWS Lambdaがコンテナをサポートしたのでちょっと試してみた](https://www.keisuke69.net/entry/2020/12/02/051538) を参考に作成。

## Setup

ECRだけ作成。

```
aws ecr create-repository --repository-name container-support-sample --image-scanning-configuration scanOnPush=true
```

## build

buildシェルを実行でアップロードできる。

```
$ ./build.sh
利用するクレデンシャルを指定してください（指定がなければdefaultになります）
profile: hoge
AWS AccountIdを指定してください（ECRで使います）
account_id: hoge
```


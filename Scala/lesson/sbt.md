# sbtについて
## 概要
Scalaの標準的なビルドツールであるsbtというツールを用いることになります。

## 導入
### 1. repoを取得
```
curl https://bintray.com/sbt/rpm/rpm | sudo tee /etc/yum.repos.d/bintray-sbt-rpm.repo
```
### 2. yumでインストール
```
yum install sbt
```
### 3. javaも必要となるのでインストール
```
yum install java-1.8.0-openjdk
```

これで導入は完了です。

## 使い方
### 対話的に実行
他のプログラムでも導入されているが、Scalaでも対話的に実行ができます。  
実行は下記コマンドで行なえます。
```
sbt console
```
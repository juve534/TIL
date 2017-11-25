# nvm
## 概要
Node Version Managerの略。  
Node.jsはバージョン変更が頻繁の上、バージョンによって動いたり動かなかったりが多い。  
このnvmならNode.jsのバージョンを一律に管理できるので、Node.jsのバージョンアップ or ダウンを安全に行うことができる。

## 導入
### 1. Gitでプロジェクトクローン
```
git clone https://github.com/creationix/nvm.git ~/.nvm
```
### 2. sourceで有効化
```
source ~/.nvm/nvm.sh
```
### 3. vagrantユーザで実行できるように所有権変更
```
sudo chown vagrant.vagrant .nvm/
```

## 使い方
### 1. リモートのバージョン確認
```
nvm ls-remote
```
### 2. 使いたいバージョンをインストール
```
nvm install v7.7.4
```
### 3. ローカルのバージョンを確認
```
nvm ls
```
### 4. 使うバージョンをセット
```
use nvm v7.7.4
```

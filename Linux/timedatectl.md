# CentOS7でタイムゾーンを変更

## 概要
CentOS6では[こちら](https://qiita.com/azusanakano/items/b39bd22504313884a7c3)の方法で変更していましたが、CentOS7ではもっと簡単に変えられたのでメモしていきます。

## 変更方法
timedatectlコマンドを使うことで手早く変更することが出来ます。
timedatectlコマンドはCentOS7から使えるコマンドで、日時設定の取得やタイムゾーンの変更を行うことが出来ます。

```
// タイムゾーンの一覧を取得
timedatectl list-timezones

// タイムゾーンの変更
timedatectl set-timezone 変更したいタイムゾーン
例). timedatectl set-timezone Asia/Tokyo
```

## 参考資料
CentOS7 タイムゾーン・時刻・日付の設定方法
http://www.server-memo.net/centos-settings/centos7/timedatectl.html
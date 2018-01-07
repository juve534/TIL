# CentOSのサービス管理

## 概要
サービスの管理するシステムについて操作方法をまとめます。

## 操作方法
CentOS6以前と7系ではコマンドが違うため、それぞれ記載します。

### CentOS6以前

```
service [サービス名] [状態]
service httpd start
```

CentOS6以前はサービスの自動起動の設定は下記コマンドで行います。

```
chkconfig []サービス名] on
```

### CentOS7

```
systemctl [状態] [サービス名]
systemctl status nginx
```

CentOS7ではサービスの自動起動の設定もsystemctlコマンドでできます。

```
systemctl enable [サービス名]
```
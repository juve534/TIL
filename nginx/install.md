# CentOS7にインストール

パッケージを登録
```
sudo rpm -ivh  http://nginx.org/packages/centos/7/noarch/RPMS/nginx-release-centos-7-0.el7.ngx.noarch.rpm
```

インストール
```
yum -y install nginx
```

インストール確認
```
nginx -v
```
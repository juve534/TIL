# CentOS7にHHVMをインストール
## 概要
[本家Github](https://github.com/facebook/hhvm/wiki/Prebuilt-Packages-on-Centos-7.x)にインストール方法あり

## 手順
まずはCentOSを更新

```
yum update -y
```

EPELリポジトリ更新

```
rpm -Uvh http://dl.fedoraproject.org/pub/epel/7/x86_64/e/epel-release-7-9.noarch.rpm
```

依存関係のあるライブラリ更新

```
yum install cpp gcc-c++ cmake git psmisc {binutils,boost,jemalloc,numactl}-devel \
{ImageMagick,sqlite,tbb,bzip2,openldap,readline,elfutils-libelf,gmp,lz4,pcre}-devel \
lib{xslt,event,yaml,vpx,png,zip,icu,mcrypt,memcached,cap,dwarf}-devel \
{unixODBC,expat,mariadb}-devel lib{edit,curl,xml2,xslt}-devel \
glog-devel oniguruma-devel ocaml gperf enca libjpeg-turbo-devel openssl-devel \
mariadb mariadb-server make libc-client -y
```

HHVMインストール

```
rpm -Uvh http://mirrors.linuxeye.com/hhvm-repo/7/x86_64/hhvm-3.15.3-1.el7.centos.x86_64.rpm
```

バージョン確認

```
hhvm --version
```
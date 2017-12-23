# CentOS7にGitの最新をインストールする
## 概要
CentOSのyumでは最新のGitをインストールすることができません。  
そのため、最新のGitをインストールする手順をまとめていきます。

## 手順
### yumでインストールされたGitのアンインストール
もし事前にyumでGitをインストールしている場合は、先にアンインストールしてください。

```
yum remove -y git
```

### 必要パッケージのインストール
Gitをソースインストールする際に必要となるパッケージをインストールします。

```
yum -y install curl-devel expat-devel gettext-devel openssl-devel zlib-devel gcc wget perl-ExtUtils-MakeMaker
```

### ダウンロード
[公式サイト](https://www.kernel.org/pub/software/scm/git/)からGitをダウンロードします。  
2017/12/23時点では2.15.1が最新でした。

```
wget https://www.kernel.org/pub/software/scm/git/git-2.15.1.tar.gz
```

ダウンロードが終わったら解凍して下さい。

```
tar xzvf git-2.15.1.tar.gz
```

### インストール
ダウンロードが終わりましたら、makeインストールします。

```
$ cd git-2.15.1
$ sudo make prefix=/usr/local all
$ sudo make prefix=/usr/local install
$ source /etc/profile
```

インストールが正常に完了しましたら、バージョンを確認します。

```
$ git --version
git version 2.15.1
```

これで最新のバージョンのインストールが完了です。


## 躓き
### エラー1
```
$ make prefix=/usr/local all
GIT_VERSION = 2.15.1
    * new build flags
    CC credential-store.o
/bin/sh: cc: コマンドが見つかりません
make: *** [credential-store.o] エラー 127
```
gccがインストールされていないことが原因なので下記を実行します。

```
yum install -y gcc
```

### エラー2
```
/usr/bin/perl Makefile.PL PREFIX='/usr/local' INSTALL_BASE='' --localedir='/usr/local/share/locale'
Can't locate ExtUtils/MakeMaker.pm in @INC (@INC contains: /usr/local/lib64/perl5 /usr/local/share/perl5 /usr/lib64/perl5/vendor_perl /usr/share/perl5/vendor_perl /usr/lib64/perl5 /usr/share/perl5 .) at Makefile.PL line 3.
BEGIN failed--compilation aborted at Makefile.PL line 3.
make[1]: *** [perl.mak] エラー 2
make: *** [perl/perl.mak] エラー 2
```

perl-ExtUtils-MakeMakerがインストールされていないことが原因のため、インストールします。

```
yum -y install perl-ExtUtils-MakeMaker
```

## 参考資料
最新バージョンGitインストール
https://qiita.com/mochimochi-inu/items/914debabca56acc20a6d
# phpenvで複数のPHPバージョンを管理
## 概要
最近PHP7.2.0がリリースされたように、PHPのバージョンも日々進化しています。  
PHPのバージョンが上がる度に、インストールし直すのはめんどうなので、phpenvを使ってバージョンを管理してみます。

## 導入
### phpenvインストール
phpenvのインストールはGitから行うため、事前にGitのインストールを行って下さい。  
まずはGitからリポジトリをインストールし、シェルを実行します。

```
$ git clone https://github.com/CHH/phpenv.git
$ cd phpenv/bin
$ ./phpenv-install.sh
```

すると、下記の文言が表示されるので、.bashrcに追加し、読み込み直します。

```
export PATH="/home/vagrant/.phpenv/bin:$PATH"
eval "$(phpenv init -)"
```
```
source ~/.bashrc
```

### php-buildをインストール
php-buildをphpenv内にインストールします。

```
git clone https://github.com/CHH/php-build.git ~/.phpenv/plugins/php-build
```

### 依存関係のあるパッケージをインストール
まずはepelをインストールします。

```
yum -y install epel-release
```

次に依存パッケージを一気にインストールします。  
ここでインストールしておくことで、phpenvを使ったインストール時に躓かなくて済みます。

```
yum -y install gcc libxml2 libxml2-devel libcurl libcurl-devel libpng libpng-devel libmcrypt libmcrypt-devel libtidy libtidy-devel libxslt libxslt-devel openssl-devel bison libjpeg-turbo-devel readline-devel autoconf bzip2-devel libicu-devel gcc-c++
```

### phpenvでPHPをインストール
準備は整ったので、PHPをインストールしていきます。  
まずは導入できるPHPのバージョンを確認します。  
最新バージョンは[公式サイト](https://secure.php.net/downloads.php)で確認して下さい。

```
$ phpenv install --list
```

017/12/23時点では7.2.0が最新でしたので、7.2.0をインストールします。  
実行が始まり、successfullyが表示されたら導入完了です。

```
$ phpenv install 7.2.0
[Success]: Built 7.2.0 successfully.
```

この時点ではパスが通っていないので、PHPコマンドを実行してもエラーとなります。

```
$ php -v
rbenv: php: command not found

The `php' command exists in these PHP versions:
  7.2.0
```

パスを通して再実行します。  
バージョンが表示されればOKです。

```
$ phpenv global 7.2.0
$ php -v
PHP 7.2.0 (cli) (built: Dec 23 2017 03:00:27) ( NTS )
Copyright (c) 1997-2017 The PHP Group
Zend Engine v3.2.0, Copyright (c) 1998-2017 Zend Technologies
    with Zend OPcache v7.2.0, Copyright (c) 1999-2017, by Zend Technologies
    with Xdebug v2.6.0alpha1, Copyright (c) 2002-2017, by Derick Rethans
```

## 躓き
### エラー1
phpenvでPHPをインストールしようとしたところ、下記のエラーが発生しました。

```
error: Please reinstall the BZip2 distribution
```

bzip2-develがなかったため、インストールしました。
```
yum install -y bzip2-devel
```

### エラー2
PHPをインストールしようとし、再びエラーが発生しました。

```
error: Unable to detect ICU prefix or no failed. Please verify ICU install prefix and make sure icu-config works.
```

libicu-develがなかったのが原因のようなのでインストールします。

```
yum install -y libicu-devel
```

### エラー3
三度エラーが発生しました。

```
configure: error: in `/tmp/php-build/source/7.2.0':
configure: error: C++ preprocessor "/lib/cpp" fails sanity check
```

gcc-c++がなかったのが原因のようなのでインストールします。

```
yum -y install gcc-c++
```
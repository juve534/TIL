# 環境構築
## Redisのインストール
wget http://download.redis.io/releases/redis-3.2.5.tar.gz
tar xvf redis-3.2.5.tar.gz
cd redis-3.2.5
make
make install

## redisユーザとディレクトリを作成、設定ファイル準備
sudo groupadd redis
sudo useradd -s /sbin/nologin -M -g redis redis
sudo mkdir /etc/redis /var/run/redis /var/log/redis
sudo chmod 755 /etc/redis /var/run/redis /var/log/redis
sudo chown redis:redis /etc/redis /var/run/redis /var/log/redis
sudo cp -p redis.conf /etc/redis/6379.conf

## PHPのExtensionを追加
cd /usr/local/src
git clone https://github.com/phpredis/phpredis.git
cd phpredis
phpize
./configure
make
make install
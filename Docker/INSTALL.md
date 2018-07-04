# CentOS7にDockerをインストールする

## 概要
リモートの環境構築もローカル同様にDockerを利用したいので、CentOS7にDockerをインストールしていきます。  
手順は[公式](https://docs.docker.com/install/linux/docker-ce/centos/)に乗っているものを使います。

## TL;DR

```
1. sudo su
2. yum install -y yum-utils device-mapper-persistent-data lvm2
3. yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
4. yum makecache fast
5. yum list docker-ce.x86_64 --showduplicates | sort -r
6. yum install -y docker-ce
7. systemctl start docker
8. docker run hello-world
```

## 導入

### 1. sudo権限の持つユーザに変更

```
sudo su
```

### 2. 必要なパッケージインストール

```
yum install -y yum-utils device-mapper-persistent-data lvm2
```

### 3. レポジトリ追加

```
yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
```

### 4. yumのパッケージインデックスを更新

```
yum makecache fast
```

### 5. インストール可能バージョンを調べる

```
yum list docker-ce.x86_64 --showduplicates | sort -r
```

### 6. 最新バージョンをインストール

```
yum install -y docker-ce
```

### 7. Docker起動

```
systemctl start docker
```

### 8. Dockerを確認する

```
docker run hello-world
```

### 9. 通常ユーザでも使えるようにする

```
sudo usermod -aG docker $USER
```

このあとに8のコマンドを実行する。

## 補足

[CentOS7にDockerをインストールする](https://qiita.com/inakadegaebal/items/be9fecce813cebec5986)
# 初めてのAnsible

## 概要
Chef, Puppetなどと同様に構成管理ツールと呼ばれるツールである。
サーバ構築のコスト削減やサーバ構築時に発生する差分を抑える事ができるメリットが有る。

何台もあるサーバに一々コマンドを打つ必要がなくなる上に、サーバ関での差分も撲滅できるので人気らしい。

## インストール
スーパーユーザ or sudoをつけて実行。
今回はCentOSに入れたので不要だったが、実行前にpythonをインストールしておく必要がある。

```
yum -y install epel-release
yum -y install ansible
ansible --version
```
## 構成
### Inventory
対象サーバのIPを記載する。
グルーピングも可能で、Webサーバ・DBサーバのIPを1つのファイルで管理できる。

### ansible.cfg
設定ファイル

### Playbook
インストールやディレクトリ作成など実行する処理を記載する。

## お試し
物は試しということで、普段よく使う locate コマンドをインストールする Playbook を作成してみる。

```locate.yml
- hosts: 127.0.0.1
  become : true
  tasks:
    - name: install locate
      yum : name=mlocate state=latest

    - name: locate updatedb
      command : updatedb
```

では、実行してみる。

```
$ ansible-playbook locate.yml

PLAY [local] ************************************************************************************************************************************************************************************

TASK [Gathering Facts] **************************************************************************************************************************************************************************
ok: [127.0.0.1]

TASK [install locate] ***************************************************************************************************************************************************************************
changed: [127.0.0.1]

TASK [locate updatedb] **************************************************************************************************************************************************************************
changed: [127.0.0.1]

PLAY RECAP **************************************************************************************************************************************************************************************
127.0.0.1                  : ok=3    changed=2    unreachable=0    failed=0
```

これでコマンドのインストールと実行準備ができた。
今回はお試しなのでここまで。
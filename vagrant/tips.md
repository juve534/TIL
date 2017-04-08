# vagrantの基本
# 概要

---------------------------------------
vagrantで利用する基本的なコマンドをメモします。

## コマンド
### Boxファイルを取得

仮想環境のベースとなるOSのテンプレートを取得してvagrantに追加するコマンドです。
http://www.vagrantbox.es/ で配布されていたり、有志の方が配っていたりします。
また、パッケージファイルからでも取得できます。

```
vagrant box add 取得するURL or パッケージファイル名
```

### Boxファイル一覧の確認

自分のvagrantに登録されているBOXファイルを全て確認できます。

```
vagrant box list
```

### Box生成

登録されているBOX名を基に仮想環境を作成します。

```
vagrant init box名
```

### Box生成後に利用する基礎的なコマンド

```
// 仮想環境の状態確認
vagrant status

// 仮想環境立ち上げ
vagrant up

// 仮想環境の保存
vagrant suspend
```

### オリジナルのBoxを作成

```
// Boxファイル生成
vagrant package

// Boxを登録
vagrant box add ボックス名 package.box

// 登録されたか確認
vagrant box list
```
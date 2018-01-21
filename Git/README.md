# Git
## 概要
Gitについて理解するためにsourcetreeをなるだけ頼らずにコマンドメインで生活し始めました。  
まだまだ操作になれないので、コマンドをメモしていきます。

## コマンド
### developの追跡ブランチをローカルで作成するとき

```
git checkout -b develop --track origin/develop
```

### featureブランチ
#### ブランチ作成と切り替え

```
// ブランチ作成
git branch feature/ブランチ名

// 切り替え
git checkout feature/ブランチ名

// ブランチ作成と切り替えを一気に
git checkout -b feature/ブランチ名
```

#### ローカルでfeatureブランチを作成してリモートに反映するとき

```
git push origin feature/ブランチ名
```

### リポジトリ
#### リモートリポジトリで削除されたブランチをローカルリポジトリで削除

```
git fetch --prune
```
プロジェクトやグローバルの設定に書き込む場合は下記コマンドを実行します。

```
git config (--global) fetch.prune true
```

### コミット
最初のコミットはrebase等がやりづらいので空コミット(--allow-empty)が良いらしいです。  
https://qiita.com/NorsteinBekkler/items/b2418cd5e14a52189d19

```
git commit --allow-empty -m "first commit"
```

#### ファイル移動
Gitで管理しているファイルを別のディレクトリへ移動させたいときは、  
下記コマンドで移動させ、Gitのindexも更新すること。

```
git mv [移動したいファイル/ディレクトリのパス] [移動後のディレクトリのパス]
```
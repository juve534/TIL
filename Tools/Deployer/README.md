# Deployer
## 概要
Deployerについて学習したことをまとめる。

## Deployerとは？
PHP製のデプロイツール。  
類似としてRuby製のCapistranoがある。  

各フレームワークのレシピが既に用意されており、レシピがあるフレームワークのdeployは手軽にできる。  
※動作はPHP7以上

## 導入
導入方法は.pharファイルをダウンロードする方法と、composerでダウンロードする方法がある。
[公式サイト](https://deployer.org)に方法が記載されているので、用途に応じて導入する。  

今回はcomposerでインストールした。

## 使い方

### 事前準備
composerでインストールした場合はvendor/deployer/deployer/bin/depを実行する必要がある。　　
パスが長いので、composerのscriptsに記載する。

```
"scripts": {
    "dep": "vendor/deployer/deployer/bin/dep"
}
```

### 初期化
Deployerを導入したらまずは初期化を行う。  

```
$ dep init


  Welcome to the Deployer config generator  



 This utility will walk you through creating a deploy.php file.
 It only covers the most common items, and tries to guess sensible defaults.

 Press ^C at any time to quit.

 Please select your project type [Common]:
  [0 ] Common
  [1 ] Laravel
  [2 ] Symfony
  [3 ] Yii
  [4 ] Yii2 Basic App
  [5 ] Yii2 Advanced App
  [6 ] Zend Framework
  [7 ] CakePHP
  [8 ] CodeIgniter
  [9 ] Drupal
  [10] TYPO3
 > 使っているフレームワークの番号を選択。なければ0でいいかな。

 Repository []:
 > リポジトリのGitURL

 Contribute to the Deployer Development

 In order to help development and improve Deployer features in,
 Deployer has a setting for collection of usage data. This function
 collects anonymous usage data and sends it to Deployer. The data is
 used in Deployer development to get reliable statistics on which
 features are used (or not used). The information is not traceable
 to any individual or organization. Participation is voluntary,
 and you can change your mind at any time.

 Anonymous usage data contains Deployer version, php version, os type,
 name of the command being executed and whether it was successful or not,
 exception class name, count of hosts and anonymized project hash.

 If you would like to allow us to gather this information and help
 us develop a better tool, please add the code below.

     set('allow_anonymous_stats', true);

 This function will not affect the performance of Deployer as
 the data is insignificant and transmitted in separate process.

 Do you confirm? (yes/no) [yes]:
 > no
```

## 参考資料
Deployer — Getting Started  
https://deployer.org/docs

Deployer を使ってLaravel5 をDeploy してみる - yujiro's blog  
http://bamboo-yujiro.hatenablog.com/entry/2017/10/07/002537
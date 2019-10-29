# CloudFormation

## 概要

* AWS用の構成管理ツール
* JSONやyamlで記載
* スタックで管理
  * リソースの集合体（EC2, WAF）

AWSで構成管理できる。  
スタック単位で管理し、スタックにはリソースの集合体がぶら下がる。  
そのため、スタックの構築や破棄でAWSのリソースを操作できる。  

JSONやyamlで管理されているため、コードとして保存することができ、再現性が高くなっている。  
※属人化を解決しやすい

```yml
AWSTemplateFormatVersion: '2010-09-09'
Resources:
  FirstVPC:
    Type: AWS::EC2::VPC
    Properties:
      CidrBlock: 10.0.0.0/16
```

2019/10/30現在もAWSTemplateFormatVersionは'2010-09-09'を定義すれば良いっぽい。
(FYI [形式バージョン - AWS CloudFormation](https://docs.aws.amazon.com/ja_jp/AWSCloudFormation/latest/UserGuide/format-version-structure.html))

```
Resources:
  <Logical ID>:
    Type: <Resource type>
    Properties:
      <Set of properties...>
```

Resourcesはリソースを定義する箇所。  
VPCでもEC2でも、利用したいリソースを定義する。  

* Logical ID
  * テンプレート内で一意の値
  * 他のリソースから参照するときに使える
  * スタックの一覧もこの名前ででる
* Resource type
  * 実際に作成したいリソース
* Resource properties
  * 各リソースの作成時に指定するプロパティ
  * CidrBlockとかVPCのIDとか

下記のテンプレートは、FirstVPCという名前で、 `10.0.0.0/16` をレンジとするVPCを作成している。
```yml
AWSTemplateFormatVersion: '2010-09-09'
Resources:
  FirstVPC:
    Type: AWS::EC2::VPC
    Properties:
      CidrBlock: 10.0.0.0/16
```


## 参考
* [【CloudFormation入門1】5分と6行で始めるAWS CloudFormationテンプレートによるインフラ構築 ｜ DevelopersIO](https://dev.classmethod.jp/cloud/aws/cloudformation-beginner01/)
* [AWS Black Belt Online Seminar 2016 AWS CloudFormation](https://www.slideshare.net/AmazonWebServicesJapan/aws-black-belt-online-seminar-2016-aws-cloudformation)
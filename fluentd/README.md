# EC2のログをfluentdでCloudWatchに投げる

## 概要
`fluentd` でEC2のログを `CloudWatchLog` に投げていきます。  

## 導入
まずは公式サイトに沿って導入します。

```
$ curl -L https://toolbelt.treasuredata.com/sh/install-amazon2-td-agent3.sh | sh
```

次にCloudWatchに投げたいので、プラグインを導入します。  
プラグインは [fluent-plugin-cloudwatch-logs](https://github.com/fluent-plugins-nursery/fluent-plugin-cloudwatch-logs)を使います。

```
$ td-agent-gem install fluent-plugin-cloudwatch-logs
```

次にApacheをインストールします。
fluentdがアクセスできるように、ログディレクトリの権限変更も行います。

```
$ yum install -y httpd
$ chmod 777 -R /var/log/httpd
```

これで事前準備はOKです。

## 設定

設定は `/etc/td-agent/td-agent.conf` に記載します。  
今回はテストとして、Apacheのログをターゲットにします。

```/etc/td-agent/td-agent.conf

# アクセスログ
<source>
  @type tail
  format apache
  path /var/log/httpd/access_log
  pos_file /var/log/td-agent/httpd.access.log.pos
  tag td.apache.access
</source>

# logsへログを転送
<match td.apache.**>
  @type cloudwatch_logs
  region ap-northeast-1
  aws_key_id 
  aws_sec_key 
  log_group_name apache
  auto_create_stream true
  use_tag_as_stream true
</match>
```

これで設定はOKです。

では早速動かしてみます。

```
$ systemctl start td-agent
```

これで起動したので、ログを吐き出してみます。

```
$ curl -vvv http://127.0.0.1
```

するとCloudWatchのapacheロググループに、td.apache.accessというログストリームができ、Apacheのアクセスログがあることが確認できると思います。

簡易的ですが、以上で終了です。
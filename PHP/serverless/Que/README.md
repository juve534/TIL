# SQSのWokerをLambdaで用意する

## Summary
[brefを使って簡単にLambdaのPHP Custom Runtime環境を構築する
](https://serverless.co.jp/blog/38/) を参考に実施.

## init

```
make init
```

## deploy

```
make sls CMD=deploy
```

## exec

```
aws sqs send-message --queue-url https://sqs.ap-northeast-1.amazonaws.com/<アカウントID>/<queue名> --message-body world
```
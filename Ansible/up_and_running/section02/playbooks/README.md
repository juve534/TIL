# 使い方
## 初めに
証明書の発行が必要なため下記コマンドを実行してください。

```
cd files
openssl req -x509 -nodes -days 3650 -newkey rsa:2048 -subj /CN=localhost -keyout nginx.key -out nginx.crt
```
### 署名書なし版
```
ansible-playbook web-notls.yml
```
### 署名書あり版
```
ansible-playbook web-tls.yml
```
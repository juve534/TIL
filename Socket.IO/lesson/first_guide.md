# Socket.IO
## 概要
WebSocketを簡単に使えるようにするLibrary。  
※WebSocketはリアルタイムの双方向通信のこと。

## 導入
事前にNode.jsやnpmをインストールしておくこと。  
npmでコマンド一発で登録できる。
```
npm install socket.io
```

## 使い方
Socket.IOはイベントの発信・受信を設定して実行する.  
設定は下記の2つを利用することで行える。
```
emit = イベント発信
on = イベント受信
```

### emitの種類
#### 接続しているSocketのみ
```
socket.emit();
```
#### 接続しているSocket以外のみ
```
socket.broadcast.emit();
```
#### 接続しているSocket全て
```
io.socket.emit();
```

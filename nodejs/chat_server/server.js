var http    = require('http');
var fs      = require('fs');
var ejs     = require('ejs');
var qs      = require('querystring');
var setting = require('./setting');
var MongoClient = require('mongodb');
var mongodb = require('./mongo');

var server  = http.createServer();
var template = fs.readFileSync('./bbs.ejs', 'utf-8');
var posts   = [];
server.on('request', function(req, res) {
    // POSTの有無で処理を切り分け
    if (req.method === 'POST') {
        // POSTされた値を格納
    	req.data = "";
    	req.on('readable', function() {
    	    req.data += req.read();
    	});

        // POST処理が終了した際は配列を表示
        req.on('end', function() {
            var query = qs.parse(req.data);
    	    posts.push(query.name);
            savaChatDetail(setting.collection, posts);
    	    renderForm(posts, res);
        });
    } else {
        // 初めてアクセスしたときはMongoDBからデータを取得する
        var documentName = setting.document;
        getChatDetail(documentName, function (result) {
            console.dir(result);
            if (result.length !== 0
                && Object.keys(result['0']).length
            ) {
                posts = result['0'][documentName];
            }
            renderForm(posts, res);
        });
    }
});
server.listen(setting.port, setting.host);
console.log('server listening ...');

/**
 * データ表示用メソッド
 * @param {array}  posts 表示するコメント
 * @param {Object} res   レスポンス
**/
function renderForm(posts, res) {
    var data = ejs.render(template, {
	    posts: posts
    });

    // ヘッダー出力
    res.writeHead(200, {'Content-Type' : 'text/html'});
    res.write(data);
    res.end();
}

/**
 * MongoDBからデータを取得する
 *
 * @param  {string} id 取得対象のコレクション
 */
var getChatDetail = function (id, callback) {
    MongoClient.connect('mongodb://' + setting.db_host + '/' + setting.db, function(err, db) {
        if (err) {
            return console.dir(err);
        }
        db.collection(setting.collection, function(err, collection) {
            collection.find({}, {chat_data:1, _id : 0}).toArray(function(err, id){
                callback(id);
            });
        });
        db.close();
    });
}

/**
 * MongoDBにデータを格納する
 *
 * @param  {string} id    取得対象のコレクション
 * @param  {array}  posts 格納するチャット内容
 */
function savaChatDetail(id, posts) {
    MongoClient.connect('mongodb://' + setting.db_host + '/' + setting.db, function(err, db) {
        if (err) {
            return console.dir(err);
        }

        var documentName = setting.document;
        var params = {};
        params[documentName] = posts;
        getChatDetail(documentName, function (result) {
            if (result.length !== 0
                && Object.keys(result['0']).length
            ) {
                var updateTarget = {};
                updateTarget[documentName] = result['0'][documentName];
                db.collection(setting.collection, function(err, collection) {
                    collection.updateOne(updateTarget, {$set : params});
                });
            } else {
                // 保険的な意味合いでDBに保存するので失敗しても無視
                db.collection(setting.collection, function(err, collection) {
                    collection.insertOne(params);
                });
            }
            db.close();
        });
    });
}
var http    = require('http');
var fs      = require('fs');
var ejs     = require('ejs');
var qs      = require('querystring');
var setting = require('./setting');
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
    	    renderForm(posts, res);
        });
    } else {
	    renderForm(posts, res);
    }
});
server.listen(setting.port, setting.host);
console.log('server listening ...');

/**
 * データ表示用メソッド
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
//var assert = require('assert');
var chai = require('chai');
var assert = chai.assert;

// テストスクリプトからの相対パスでrequire
var myfunc = require('./myfunc');

describe("myfunc", function(){
  it("加算成功", function() {
    var test = new myfunc();
    assert.equal(2, test.contract(1))
  }),
  it("nullを加算", function() {
    var test = new myfunc();
    assert.equal(1, test.contract(null))
  });
});

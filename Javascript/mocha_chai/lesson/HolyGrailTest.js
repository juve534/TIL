var assert = require('assert');

// テストスクリプトからの相対パスでrequire
var HolyGrail = require('./HolyGrail');

describe("HolyGrail", function(){
  // 凛が所持するペンダントに対応する英霊はアルトリアではない
  it("Rin tried:", function(){
      var servant = new HolyGrail();
      assert.equal("Arthur", servant.contract('pendant'));
  });
  // 士郎の体内の剣の鞘に対応する英霊はアルトリア
  it("Shiro tried:", function(){
    var servant = new HolyGrail();
    assert.equal("Arthur", servant.contract('sheath'));
  });
});

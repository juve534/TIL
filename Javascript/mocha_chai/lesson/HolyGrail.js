// 「座」に存在する英霊
const SERVANT_LIST = {
  "sheath"  : "Arthur",
  "earring" : "Cuchulain",
  "pendant" : "Emiya",
  "mirror"  : "Medusa",
  "book"    : "Medea",
  "gate"    : "Kojiro",
  "ax"      : "Hercules"
};

/**
 * @classdesc 聖杯
 */
var HolyGrail = function() {
  /**
   * 英霊召喚
   * @param {string} catalyst - 触媒
   */
  this.contract = function(catalyst) {
    var servant = SERVANT_LIST[catalyst];
    return servant;
  };
};

module.exports = HolyGrail;

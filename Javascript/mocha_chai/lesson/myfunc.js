/**
 * @classdesc 聖杯
 */
var myfunc = function () {
    /**
     *　プラス1する関数
     * 
     * @param  {[Integer]} val [数値]
     * @return {[Integer]}     [プラス1した数]
     */
    this.contract = function(val) {
        return val + 1;
    };
};

module.exports = myfunc;

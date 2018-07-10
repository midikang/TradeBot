PMapp = angular.module("PathManager",[]);

PMapp.factory("ViewSettings",function(){
  let factory = {};

  factory.dicts = {};
  factory.platforms = [];
  factory.int2name = {};

  // load dictionary
  $.post("http://localhost/tradebot/php/translateDB.php?cmd=getAllDictionaries",{},function(result){
    factory.dicts = result;
    //console.log(factory.dicts);
  },"json");

  // load platforms
  $.post("http://localhost/tradebot/php/translateDB.php?cmd=getPlatforms",{},function(result){
    factory.platforms = result;
    //console.log(factory.platforms);
  },"json");

  // load int2name dictionary
  $.post("http://localhost/tradebot/php/translateDB.php?cmd=getInt2Name",{},function(res){
    factory.int2name = res;
  },"json");

  // function to get user id and pw here
  factory.sensinfo = {"rate":-1, "pid":-1, "uid":"tester", "pw":"somethingneat"}; // default


  factory.platform1 = "";
  factory.platform2 = "";
  factory.alias1 = "";
  factory.alias2 = "";
  factory.alias3 = "";
  factory.alias4 = "";

  factory.mode = "";
  factory.changeMode = function(mode){
    if (["paths","monitors"].contains(mode)){
      this.mode = mode;
    } else {
      alert("ViewSettings.changeMode()\ngiven mode "+mode);
    }
  }
  return factory;
});

//alert("factory loaded");

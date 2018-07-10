PMapp = angular.module("PathManager",[]);

PMapp.factory("ViewSettings",function(){
  let factory = {};

  // load dictionary
  factory.dictFull = $.ajax({
    url: "http://localhost/tradebot/php/translateDB.php?cmd=getAllDictionaries",
    method: "GET",
    async : false,
    dataType: "json"
  }).responseJSON;

  // load platforms
  factory.platforms = $.ajax({
    url: "http://localhost/tradebot/php/translateDB.php?cmd=getPlatforms",
    method: "GET",
    async : false,
    dataType: "json"
  }).responseJSON;

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

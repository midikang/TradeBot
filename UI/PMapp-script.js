PMapp = angular.module("PathManager",[]);

PMapp.factory("ViewSettings",function(){
  let factory = {};

  factory.selectPlatformsURL = "http://localhost/tradebot/php/translateDB.php?cmd=getPlatforms";

  factory.selectInt2NameURL = "http://localhost/tradebot/php/translateDB.php?cmd=getInt2Name";

  factory.platforms = sendPostReceiveJSON(factory.selectPlatformsURL,{});

  $.getJSON(factory.selectInt2NameURL, function(res){
    console.log("got int2name");
    factory.int2name = res;
  });

  factory.sensinfo = {"rate":-1, "pid":-1, "uid":"tester", "pw":"somethingneat"};


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

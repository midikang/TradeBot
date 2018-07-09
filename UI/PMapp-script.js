PMapp = angular.module("PathManager",[]);

PMapp.factory("ViewSettings",function(){
  let factory = {};

  factory.int2alias = {};
  factory.platforms = {};
  factory.int2name = {};

  // load platforms and int2alias dictionary for each platforms
  $.post("http://localhost/tradebot/php/translateDB.php?cmd=getPlatforms",{},function(result){
    factory.platforms = result;

    for (let i = 0; i < factory.platforms.length; i++){
      let plat = factory.platforms[i];
      $.post(`http://localhost/tradebot/php/translateDB.php?cmd=getInt2Alias&platform=${plat}`,{},function(res){
        factory.int2alias[plat] = res;
      },"json");
    }
  },"json");

  // load int2name dictionary
  $.post("http://localhost/tradebot/php/translateDB.php?cmd=getInt2Name",{},function(res){
    factory.int2name = res;
  },"json");

  console.log(factory.platforms);
  console.log(factory.int2name);
  console.log(factory.int2alias);
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

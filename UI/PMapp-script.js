PMapp = angular.module("PathManager",[]);

PMapp.factory("ViewSettings",function(){
  let factory = {};

  // set path to local php  scripts
  factory.selectPathsURL="http://localhost/tradebot/php/pathDB.php?cmd=selectAllPaths";

  factory.selectPlatformsURL = "http://localhost/tradebot/php/translateDB.php?cmd=getPlatforms";

  factory.selectInt2NameURL = "http://localhost/tradebot/php/translateDB.php?cmd=getInt2Name";

  factory.paths = {};
  factory.monitors = {};
  $.getJSON(factory.selectInt2NameURL, function(result){
    console.log("got int2name");
    factory.int2name = result;
    $.getJSON(factory.selectPathsURL, function(result){
      console.log("adding paths");
      // result is a list in json form
      // the elements of the list are json objs with keys: pid, plat1/2,
      for( let i = 0; i < result.length; i++){
        console.log(strf("{}/{}",[i,result.length-1]));

        let row = result[i];
        let jsons = JSON.parse(row.jsons);
        let str_reprs = [];
        for (let i = 0; i < jsons.length; i++){
          let json = jsons[i];
          str_reprs.push(strf("({},{})",
                          [factory.int2name[json.head],
                          factory.int2name[json.tail]]));
        }
        factory.paths[row.pid] = {"plat1":row.plat1,"plat2":row.plat2,
                                    "str":str_reprs.join(" <> ")};
      }
    });// */
  });

  $.getJSON(factory.selectPlatformsURL,function(res){
    factory.platforms = res;
  })

  factory.platform1 = "";
  factory.platform2 = "";
  factory.alias1 = "";
  factory.alias2 = "";
  factory.alias3 = "";
  factory.alias4 = "";

  factory.mode = "paths";
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

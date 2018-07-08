PMapp.directive("zDisplay",function(){
  return{
    restrict:'E',
    scope:{},

    controller: ["$scope","ViewSettings",
    function($scope,ViewSettings){
      $scope.view = ViewSettings;
      let selectMonitorsURL="http://localhost/tradebot/php/pathDB.php?cmd=selectMonitors";
      let insertMonitorURL="http://localhost/tradebot/php/path.php?cmd=insertMonitor";
      let deleteMonitorURL="http://localhost/tradebot/php/path.php?cmd=deleteMonitor";
      //$scope.updateMonitorRateURL="http://localhost/tradebot/php/path.php?cmd=updateMonitorRate";

      let selectPathsURL="http://localhost/tradebot/php/pathDB.php?cmd=selectAllPaths";

      let sensinfo = $scope.view.sensinfo;

      // init paths
      $scope.paths = {};
      $.post(selectPathsURL,{},function(res){
        for( let i = 0; i < res.length; i++){
            //console.log(`(${i}/${res.length-1})`);
          let row = res[i];
          let jsons = JSON.parse(row.jsons);
          let str_reprs = [];
          for (let j = 0; j < jsons.length; j++){
            let json = jsons[j];
            str_reprs.push(`(${$scope.view.int2name[json.head]},${$scope.view.int2name[json.tail]})`);
          }
          $scope.paths[row.pid] = {"plat1":row.plat1,"plat2":row.plat2,
                                      "str":str_reprs.join(" <> ")};
        }
      },"json");

      // init monitors
      $scope.monitors = {};
      $.post(selectMonitorsURL,sensinfo,function(res){
        for( let i = 0; i < res.length; i++){
            console.log(`(${i}/${res.length-1})`);
          let row = res[i];
          let jsons = JSON.parse(row.jsons);
          let str_reprs = [];
          for (let j = 0; j < jsons.length; j++){
            let json = jsons[j];
            str_reprs.push(`(${$scope.view.int2name[json.head]},${$scope.view.int2name[json.tail]})`);
          }
          $scope.monitors[row.pid] = {"rate":row.rate,"plat1":row.plat1,"plat2":row.plat2,
                                      "str":str_reprs.join(" <> ")};
        }
      },"json");


      $scope.addToMonitors = function(pid){
        if($scope.monitors.hasOwnProperty(pid)){
          alert(`path #${pid} already in monitors`);
          return;
        }

        sensinfo["pid"]=pid;
        sensinfo["rate"]=10;
        $.post(insertMonitorURL,sensinfo,function(result){
          console.log(result);
        });
        $scope.monitors[pid] = $scope.paths[pid];
        $scope.monitors[pid]["rate"] = 10;
      }

      $scope.rmFromMonitors = function(pid){
        if(!$scope.monitors.hasOwnProperty(pid)){
          alert(`path #${pid} not in monitors`);
          return;
        }

        sensinfo["pid"]=pid;
        $.post(deleteMonitorURL,sensinfo, function(result){
          console.log(result);
        }, "json");
        delete $scope.monitors[pid];
      }
    }],

    template:z_displayHTML
  };
});
//alert("z-display loaded");

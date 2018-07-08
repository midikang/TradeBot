PMapp.directive("zDisplay",function(){
  return{
    restrict:'E',
    scope:{},

    controller: ["$scope","ViewSettings",
    function($scope,ViewSettings){
      $scope.view = ViewSettings;
      $scope.int2name = $scope.view.int2name;
      $scope.selectMonitorsURL="http://localhost/tradebot/php/pathDB.php?cmd=selectMonitors";
      $scope.insertMonitorURL="http://localhost/tradebot/php/path.php?cmd=insertMonitor";
      $scope.deleteMonitorURL="http://localhost/tradebot/php/path.php?cmd=deleteMonitor";
      //$scope.updateMonitorRateURL="http://localhost/tradebot/php/path.php?cmd=updateMonitorRate";

      $scope.selectPathsURL="http://localhost/tradebot/php/pathDB.php?cmd=selectAllPaths";

      $scope.sensinfo = $scope.view.sensinfo;

      $scope.retrievePaths = function(){
        let tmp = {};
        $.getJSON($scope.selectPathsURL, function(result){
          console.log("adding paths");
          for( let i = 0; i < result.length; i++){
              //console.log(`(${i}/${result.length-1})`);
            let row = result[i];
            let jsons = JSON.parse(row.jsons);
            let str_reprs = [];
            for (let j = 0; j < jsons.length; j++){
              let json = jsons[j];
              str_reprs.push(`(${$scope.int2name[json.head]},${$scope.int2name[json.tail]})`);
            }
            tmp[row.pid] = {"plat1":row.plat1,"plat2":row.plat2,
                                        "str":str_reprs.join(" <> ")};
          }

        });// */
      }
      $scope.paths = $scope.retrievePaths();

      $scope.retrieveMonitors = function(){
        let tmp = {};
        $.post(this.selectMonitorsURL,$scope.sensinfo,function(result){
          console.log("adding monitors");
          for( let i = 0; i < result.length; i++){
            //console.log(strf("{}/{}",[i,result.length-1]));

            let row = result[i];
            let jsons = JSON.parse(row.jsons);
            let str_reprs = [];
            for (let i = 0; i < jsons.length; i++){
              let json = jsons[i];
              str_reprs.push(`(${$scope.int2name[json.head]},${$scope.int2name[json.tail]})`);
            }
            tmp[row.pid] = {"rate":row.rate,"plat1":row.plat1,"plat2":row.plat2,
                                        "str":str_reprs.join(" <> ")};
          }
        },"json"); // */
        return tmp;
      }

      $scope.addToMonitors = function(pid){
        if($scope.monitors.hasOwnProperty(pid)){
          alert(`path #${pid} already in monitors`);
          return;
        }

        $scope.sensinfo["pid"]=pid;
        $scope.sensinfo["rate"]=10;
        $.post($scope.view.insertMonitorURL,$scope.sensinfo,
        function(result){
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

        $scope.sensinfo["pid"]=pid;
        $.post($scope.view.deleteMonitorURL,$scope.sensinfo,
        function(result){
          console.log(result);
        }, "json");
        $scope.monitors = $scope.view.retrieveMonitors();
      }
    }],

    template:z_displayHTML
  };
});
//alert("z-display loaded");

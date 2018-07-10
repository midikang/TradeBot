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
      $scope.paths = [];
      $.post(selectPathsURL,{},function(res){
        for( let i = 0; i < res.length; i++){
            //console.log(`(${i}/${res.length-1})`);
          let row = res[i];
          let path_jsons = JSON.parse(row.jsons);
          let str_reprs = [];
          for (let j = 0; j < path_jsons.length; j++){
            let tp = path_jsons[j];
            str_reprs.push(`(${$scope.view.dicts[tp.platform][tp.head]},
                            ${$scope.view.dicts[tp.platform][tp.tail]})`);
          }
          row.jsons = str_reprs.join(" <> ");
          //console.log(row);
          $scope.paths.push(row);
        }
      },"json");

      // init monitors
      $scope.monitors = [];
      $.post(selectMonitorsURL,sensinfo,function(res){
        for( let i = 0; i < res.length; i++){
            console.log(`(${i}/${res.length-1})`);
          let row = res[i];
          let path_jsons = JSON.parse(row.jsons);
          let str_reprs = [];
          for (let j = 0; j < path_jsons.length; j++){
            let tp = path_jsons[j];
            str_reprs.push(`(${$scope.view.dicts[tp.platform][tp.head]},
                            ${$scope.view.dicts[tp.platform][tp.tail]})`);
          }
          row.jsons = str_reprs.join(" <> ");
          $scope.monitors.push(row);
        }
      },"json");


      $scope.addToMonitors = function(path_json){
        if($scope.monitors.contains(path_json)){
          alert(`path #${path_json.pid} already in monitors`);
          return;
        }

        sensinfo["pid"]=path_json.pid;
        sensinfo["rate"]=10;
        $.post(insertMonitorURL,sensinfo,function(result){
          console.log(result);
          // if result came back successful
          path_json["rate"] = 10;
          $scope.monitors.push(path_json);
        });
      }

      $scope.rmFromMonitors = function(path_json){
        /*
        if(!$scope.monitors.contains(path_json)){
          alert(`path #${path_json.pid} not in monitors`);
          return;
        }*/

        sensinfo["pid"]=path_json.pid;
        $.post(deleteMonitorURL,sensinfo, function(result){
          console.log(result);
          // if result came back successful
          $scope.monitors.remove(path_json);
        }, "json");
      }
    }],

    template:z_displayHTML
  };
});
//alert("z-display loaded");

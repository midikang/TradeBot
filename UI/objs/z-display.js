PMapp.directive("zDisplay",function(){
  return{
    restrict:'E',
    scope:{},

    controller: ["$scope","ViewSettings",
    function($scope,ViewSettings){
      $scope.view = ViewSettings;

      $scope.masterList = {"paths":{},"monitors":{}};

      $scope.addToMonitors = function(pid){
        // check if pid is in masterList.monitors

        // add pid masterList.monitors

        // send request to change data in SQL database
      }

      $scope.rmFromMonitors = function(mon){
        // check if pid in masterList.monitors

        // add pid masterList.monitors

        // send request to change data in SQL database
      }

      $scope.setMonitorRate = function(mon){
        // update value for given monitor obj

        // send request to change data in SQL database
      }

      $scope.getPathStr = function(json_str){
        let jsons = JSON.parse(json_str);

        let str_reprs = [];
        for (let i = 0; i < jsons.length; i++){
          let json = jsons[i];
          str_reprs.push(strf("({},{})",[json.head,json.tail]));
        }
        return str_reprs.join(" <> ");
      }

      $.getJSON($scope.view.selectPathsURL, function(result){
        console.log("received json result");
        // result is a list in json form
        // the elements of the list are json objs with keys: pid, plat1/2,
        for( let i = 0; i < result.length; i++){
          console.log(strf("{}/{}",[i,result.length]));
          let row = result[i];
          $scope.masterList.paths[row.pid] = {"plat1":row.plat1,"plat2":row.plat2,
                                      "str":$scope.getPathStr(row.jsons)};
        }
        console.log("done loading json");
      });// */
    }],

    template:z_displayHTML
  };
});
//alert("z-display loaded");

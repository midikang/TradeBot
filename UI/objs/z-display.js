PMapp.directive("zDisplay",function(){
  return{
    restrict:'E',
    scope:{},

    controller: ["$scope","ViewSettings",
    function($scope,ViewSettings){
      $scope.view = ViewSettings;

      $scope.masterList = {"paths":{},"monitors":{}}; // {} in form of {pid:json obj}
      // populate masterList

      alert("gettingJSON");
      $.getJSON("http://localhost/tradebot/php/pathDB.php?cmd=selectPaths&plat1=bitfinex&plat2=binance", function(result){
        for(i in result){
          if (result.hasOwnProperty(i)){
            alert(i+"\t\t"+result[i]);
          }
        }
      });

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



    }],

    template:z_displayHTML
  };
});
//alert("z-display loaded");

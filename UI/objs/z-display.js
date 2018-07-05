PMapp.directive("zDisplay",function(){
  return{
    restrict:'E',
    scope:{},

    controller: ["$scope","ViewSettings",
    function($scope,ViewSettings){
      $scope.view = ViewSettings;

      $scope.masterList = {"paths":{},"monitors":{}}; // {} in form of {pid:json obj}
      // populate masterList

      //alert("gettingJSON");
      $.getJSON("http://localhost/tradebot/php/pathDB.php?cmd=selectPaths&plat1=bitfinex&plat2=binance", function(result){
        for(i in result){ // result is the decoded json obj
          if (result.hasOwnProperty(i)){
            //alert(i+"\t\t"+result[i]);
          }
        }
      });

      $scope.addToMonitors = function(pid){
        // check if pid is in masterList.monitors
        alert("addToMonitors()\n"+pid);
        // add pid masterList.monitors

        // send request to change data in SQL database
      }

      $scope.rmFromMonitors = function(pid){
        // check if pid in masterList.monitors
        alert("rmFromoMonitors()\n"+pid);
        // add pid masterList.monitors

        // send request to change data in SQL database
      }

      $scope.setMonitorRate = function(rate){
        // update value for given monitor obj
        alert("setMonitorRate()\n"+rate);
        // send request to change data in SQL database
      }



    }],

    template:z_displayHTML
  };
});
//alert("z-display loaded");

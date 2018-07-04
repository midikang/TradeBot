PMapp.directive("zDisplay",function(){
  return{
    restrict:'E',
    scope:{},

    controller: ["$scope","ViewSettings",
    function($scope,ViewSettings){
      $scope.view = ViewSettings;

      $scope.masterList = {"paths":{},"monitors":{}}; // {} in form of {pid:json obj}
      // populate masterList

      



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

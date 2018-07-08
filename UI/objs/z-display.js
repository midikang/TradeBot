PMapp.directive("zDisplay",function(){
  return{
    restrict:'E',
    scope:{},

    controller: ["$scope","ViewSettings",
    function($scope,ViewSettings){
      $scope.view = ViewSettings;

      $scope.addToMonitors = function(pid){
        if($scope.view.monitors.hasOwnProperty(pid)){
          alert(`path #${pid} already in monitors`);
          return;
        }

        $scope.view.setPersonalInfo("pid",pid);
        $scope.view.setPersonalInfo("rate",10);
        $.post($scope.view.insertMonitorURL,$scope.view.getPersonalInfo(),
        function(result){
          console.log(result);
        });
        $scope.view.retrieveMonitors();
      }

      $scope.rmFromMonitors = function(pid){
        if(!$scope.view.monitors.hasOwnProperty(pid)){
          alert(`path #${pid} not in monitors`);
          return;
        }

        $.post($scope.view.deleteMonitorURL,$scope.view.getPersonalInfo(),
        function(result){
          console.log(result);
        }, "json");
        $scope.view.retrieveMonitors();
      }

      $scope.setMonitorRate = function(pid,rate){
        if(!$scope.view.monitors.hasOwnProperty(pid)){
          alert(`path #${pid} not in monitors`);
          return;
        }

        $.post($scope.view.updateMonitorRateURL,$scope.view.getPersonalInfo(),
        function(result){
          console.log(result);
        }, "json");
        $scope.view.retrieveMonitors();
      }


    }],

    template:z_displayHTML
  };
});
//alert("z-display loaded");

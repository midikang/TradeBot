PMapp.directive('zFilters', function() {                    //TODO TODO TODO TODO TODO
  return {
    restrict: 'E',

    scope: {},

    controller: ["$scope","ViewSettings",
    function($scope,ViewSettings){
      $scope.view = ViewSettings;

      $scope.swapPlatforms = function(){
        let tmp = $scope.view.platform1;
        $scope.view.platform1 = $scope.view.platform2;
        $scope.view.platform2 = tmp;
      }
    }],

    template: z_filtersHTML
  };
});

alert("z-filters Loaded");

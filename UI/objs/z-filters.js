PMapp.directive('zFilters', function() {                    //TODO TODO TODO TODO TODO
  return {
    restrict: 'E',

    scope: {},

    controller: ["$scope","ViewSettings",
    function($scope,ViewSettings){
      $scope.view = ViewSettings;

      $scope.platforms = $scope.view.platforms;
    }],

    template: z_filtersHTML
  };
});

//alert("z-filters Loaded");

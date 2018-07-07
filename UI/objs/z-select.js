PMapp.directive('zSelect', function() {                    //TODO TODO TODO TODO TODO
  return {
    restrict: 'E',
    scope: {},

    controller: ['$scope',"ViewSettings",
    function ($scope,ViewSettings) {
      $scope.view = ViewSettings;

      $scope.view.changeMode("paths");
    }],
    template: z_selectHTML
  };
});

//alert("z-select loaded");

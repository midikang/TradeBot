var z_filtersHTML =''+
'<div class = "filterContainer zone">'+
  '<p class = "title"> Filters: </p>'+
  '<ol class = "platformFilters zone" ng-repeat="i in [1,2]">'+
    'Platform {{i}}: <input class = "filter" type="text" ng-model = "view.platform"+{{i}} >'+
  '</ol>'+
  '<ol class = "aliasFilters zone" ng-repeat="i in [1,2,3,4]">'+
    'Alias {{i}}: <input class = "filter" type="text" ng-model = "view.alias"+{{i}} >'+
  '</ol>'+
'</div>'
;

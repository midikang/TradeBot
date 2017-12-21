var z_tabsHTML =''+
'<div class="tab-container zone">  '+
  '<div ng-repeat="label in paneLabels">'+
    '<button id = "{{label}}" class = "tab" ng-click="select(label)">{{label}}</button>'+
  '</div>  '+
'</div>'+
'<div class="tab-content" ng-transclude></div>';

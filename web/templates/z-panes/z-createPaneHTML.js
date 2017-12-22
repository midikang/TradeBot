var z_createPaneHTML = ''+
'<div class = "panel" ng-show = "ts.selectedTab == \'create\'">'+
  '<div ng-show = "im.cform" class = "form-container">'+
    '<br>'+
    '<a ng-click = "deleteCForm()">X</a>'+
    '<a class = "formTitle YellowBG">{{im.cform.getTitle()}}</a>'+
    '<br><br>'+
    '<div class = "component-outter" ng-repeat = "component in im.cform.getComp()">'+
      '<div class = "component-inner">'+
        '<a ng-click = "rmComponent($index)">X</a>'+
        '<div ng-repeat = "(key,val) in component.getData()">'+
          '<a ng-click = "updateKey(key,component)">{{key}}</a>:<button>{{component.getUpdateLabel()}}</button>'+
        '</div>'+
      '</div>'+
    '</div>'+
    '<br>'+
    '<button ng-click = "newInfo()"> Add Info </button>'+
    '<button ng-click = "newCounter()">Add Counter</button>'+
    '<button ng-click = "newPoll()">Add Poll</button>'+
  '</div>'+
  '<div ng-show = "!im.cform"> <big><big>'+
  'Make a form by clicking the "New forms" button \xa0\xa0 --- ></big></big></div>'+
'</div>';

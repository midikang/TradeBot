var z_viewerPaneHTML = ''+
'<div class = "panel" ng-show = "ts.selectedTab == \'viewer\'">'+
  '<div ng-show = "im.cfolder && im.cform && im.crecord">'+
    '<a class = "zone formTitle yellowBG"> {{im.cfolder.getFormUsedTitle()}}</a>'+
    '<br>'+
    'Date Time: <a class = "zone yellowBG"> {{im.crecord.getTitle()}}</a>'+
    '<br><br>'+
    '<div class = "component-outter" ng-repeat = "component in im.crecord.getDetails()">'+
      '<div class = "component-inner" ng-show = "!isDefaultLabel(key)" '+
      'ng-repeat = "(key,val) in component.getData()">'+
        '<a>{{key}}</a>\xa0\xa0:\xa0\xa0\xa0'+
        '<button ng-click = "updateVal(component,key)">{{component.getUpdateLabel()}}</button>'+
        '\xa0\xa0\xa0\xa0\xa0 {{val}}'+
      '</div>'+
    '</div>'+
    '<br><br>'+
    'Extra Notes:'+
    '<div class = "textNewLine zone" ng-click = "updateExtraNotes()">'+
    '{{im.crecord.getExtraNotes()}}</div>'+
    '<button ng-click = "clearFields()"> Clear Fields </button>'+
    '<button ng-click = "deleteRecord()"> Delete Record </button>'+
  '</div>'+
  // helper msgs---------------------------------------------------
  '<div ng-show = "!im.cfolder"> <big><big>'+
  '< --- \xa0\xa0Make a folder by clicking on the "home" tab</big></big></div>'+
  '<div ng-show = "!im.cform"> <big><big>'+
  '< --- \xa0\xa0Make a form by clicking on the "create" tab</big></big></div>'+
  '<div ng-show = "im.cfolder && im.cform && !im.crecord"> <big><big>'+
  'Make a record by clicking on the "New records" button \xa0\xa0--- ></big></big></div>'+
'</div>';

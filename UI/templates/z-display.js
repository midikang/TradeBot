var z_displayHTML = ''+/*
'<div ng-show = "im.mode !== \'folders\'">'+
  '<a class = "addItemButton" ng-click = "addFolder()">New Folder</a>'+
  '<ul class="item-container">  '+
      '<ol class = "item" ng-repeat="folder in folders">'+
        '<button class = "{{folder.highlight}} itemButton" '+
        'ng-click = "selectFolder(\"folder\",folder)">{{folder.title}}</button>'+
      '</ol>  '+
  '</ul>'+
'</div>'+
//--------------------------------------------------------------------------------------
'<div ng-show = "im.mode == \'records\'">'+
  '<a class = "addItemButton" ng-click = "addRecord()">New Record</a>'+
  '<ul class="item-container">  '+
      '<ol class = "item" ng-repeat="record in records">'+
        '<button class = "{{record.highlight}} itemButton" '+
        'ng-click="selectItem(\"record\",record)">{{record.title}}</button>'+
      '</ol>  '+
  '</ul>'+
'</div>'+
//--------------------------------------------------------------------------------------
'<div ng-show = "im.mode == \'forms\'">'+
  '<a class = "addItemButton" ng-click = "addForm()">New Form</a>'+
  '<ul class="item-container">  '+
      '<ol class = "item" ng-repeat="form in forms">'+
        '<button class = "{{form.highlight}} itemButton" '+
        'ng-click="selectItem(\"form\",form)">{{form.title}}</button>'+
      '</ol>  '+
  '</ul>'+
'</div>';
/*/
'<div class = "displayContainer zone">'+
  '<ul class="pathsContainer" ng-show = "view.mode = \"paths\"">  '+
      '<ol class = "path" ng-repeat="() in masterList.paths">'+
        '<button class = "addButton" ng-click=addToMonitors(path.pid)</button>'+
        '<p class = "platform">{{path.plat1}}</a>'+
        '<p class = "pathStr">{{getPathStr(path.pid)}}</a>'+
        '<p class = "platform">{{path.plat2}}</a>'+
      '</ol>  '+
  '</ul>'+
  '<ul class="monitorsContainer" ng-show = "view.mode = \"monitors\"">  '+
      '<ol class = "monitor" ng-repeat="monitor in masterList.monitors">'+
        '<button class = "rmButton" ng-click=rmFromMonitors(monitor)</button>'+
        '<p class = "monitorRate" ng-click = "setMonitorRate(monitor)">{{monitor.rate}}</p>'+
        '<p class = "platform">{{monitor.plat1}}</a>'+
        '<p class = "pathStr">{{monitor.pathStr}}</a>'+
        '<p class = "platform">{{monitor.plat2}}</a>'+
      '</ol>  '+
  '</ul>'+
'</div>';
//*/

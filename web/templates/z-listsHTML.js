var z_listsHTML = ''+/*
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
'<div ng-show = "im.mode !== \'void\'">'+
  '<a class = "addItemButton" ng-click = "addItem(im.mode)">New {{im.mode}}</a>'+
  '<ul class="item-container">  '+
      '<ol class = "item" ng-repeat="item in im.cItemList">'+
        '<button class = "{{item.highlight}} itemButton" '+
        'ng-click = "selectItem(im.mode,item)">{{item.getTitle()}}</button>'+
      '</ol>  '+
  '</ul>'+
'</div>'
//*/

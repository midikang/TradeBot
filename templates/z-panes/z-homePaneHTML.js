var z_homePaneHTML = ''+
'<div class="panel" ng-show = "ts.selectedTab == \'home\'">'+
  '<div ng-show = "im.cfolder">'+
    '<a id = "folderTitle" ng-click = "updateFolderTitle()" class = "zone yellowBG">{{im.cfolder.getTitle()}}</a>'+
    '<br><br>'+
    '<a id = "folderDate" class = "zone yellowBG">{{im.cfolder.getDateTime()}}</a>'+
    '<br><br><br>'+
    '<big><big><big>Folder Description :</big></big></big>'+
    '<div id = "folderDescription"  class = "textNewLine zone" '+
    'ng-click = "updateFolderDescription()">{{im.cfolder.description}}</div>'+
  '</div>'+
  '<div ng-show = "!im.cfolder"> <big><big>'+
  'Make a folder by clicking the "New folders" button \xa0\xa0 --- ></big></big></div>'+
'</div>';

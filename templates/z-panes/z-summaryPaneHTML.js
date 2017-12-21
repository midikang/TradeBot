var z_summaryPaneHTML = ''+
'<div class = "panel" ng-show = "ts.selectedTab == \'summary\'">'+
  '<button ng-click = "updateSum()"> Refresh </button>'+
  '<div class = "component-container">'+
    '<a class = "zone formTitle yellowBG"> {{im.cfolder.getFormUsedTitle()}}</a>'+
    //'<a class = "zone yellowBG"> {{im.crecord.getTitle()}}</a> <br><br>'+ //from what time to what time
    '<div class = "component-outter" ng-repeat = "component in im.cfolder.getTotals()">'+
      '<div class = "component-inner">'+
        '<div ng-repeat = "(key,tot) in component">'+
          '<a>{{key}}</a>\xa0\xa0:\xa0\xa0\xa0<a class = "totals">{{tot}}</a>'+
        '</div>'+
      '</div>'+
    '</div>'+
  '</div>'+
'</div>';

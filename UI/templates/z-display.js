var z_displayHTML = `
<div class = "displayContainer zone">
  <ul class="pathsContainer" ng-show = "view.mode = 'paths'">
      <ol class = "path" ng-repeat="() in masterList.paths">
        <button class = "addButton" ng-click=addToMonitors(path.pid)</button>
        <p class = "platform">{{path.plat1}}</a>
        <p class = "pathStr">{{getPathStr(path.pid)}}</a>
        <p class = "platform">{{path.plat2}}</a>
      </ol>
  </ul>
  <ul class="monitorsContainer" ng-show = "view.mode = 'monitors'">
      <ol class = "monitor" ng-repeat="monitor in masterList.monitors">
        <button class = "rmButton" ng-click=rmFromMonitors(monitor)</button>
        <p class = "monitorRate" ng-click = "setMonitorRate(monitor)">{{monitor.rate}}</p>
        <p class = "platform">{{monitor.plat1}}</a>
        <p class = "pathStr">{{monitor.pathStr}}</a>
        <p class = "platform">{{monitor.plat2}}</a>
      </ol>
  </ul>
</div>`;
//*/

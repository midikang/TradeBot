var z_displayHTML = `
<ul class="listContainer" ng-show = "view.mode == 'paths'">
    <a class = "label platform">platform 1</a>
    <a class = "label pathStr">path</a>
    <a class = "label platform">platform 2</a>
    <br>
    <ol class = "path" ng-repeat="() in masterList.paths">
      <button class = "addButton" ng-click=addToMonitors(path.pid)</button>
      <a class = "platform">{{path.plat1}}</a>
      <a class = "pathStr">{{getPathStr(path.pid)}}</a>
      <a class = "platform">{{path.plat2}}</a>
    </ol>
</ul>
<ul class="listContainer" ng-show = "view.mode == 'monitors'">
    <a class = "label monitorRate" >Monitor rate (sec)</p>
    <a class = "label platform">platform 1</a>
    <a class = "label pathStr">path</a>
    <a class = "label platform">platform 2</a>
    <br>
    <ol class = "monitor" ng-repeat="monitor in masterList.monitors">
      <button class = "rmButton" ng-click=rmFromMonitors(monitor.pid)</button>
      <a class = "monitorRate" ng-click = "setMonitorRate(monitor)">{{monitor.rate}}</p>
      <a class = "platform">{{monitor.plat1}}</a>
      <a class = "pathStr">{{monitor.pathStr}}</a>
      <a class = "platform">{{monitor.plat2}}</a>
    </ol>
</ul>
`;
//*/

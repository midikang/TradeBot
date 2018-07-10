var z_displayHTML = `
<table class="listContainer" ng-show = "view.mode == 'paths'">
    <tr>
      <th></th>
      <th class = "pid">pid</th>
      <th class = "platform">platform 1</th>
      <th class = "pathStr">path</th>
      <th class = "platform">platform 2</th>
    </tr>
    <tr class = "path" ng-repeat="path_obj in paths | filter:view.platform1 | filter:view.platform2 as pList track by path_obj.pid">
      <td> <button class = "addButton" ng-click=addToMonitors(path_obj)>+</button></td>
      <td class = "pid">{{path_obj.pid}}</td>
      <td class = "platform">{{path_obj.plat1}}</td>
      <td class = "pathStr">{{path_obj.jsons}}</td>
      <td class = "platform">{{path_obj.plat2}}</td>
    </tr>
</table>
<table class="listContainer" ng-show = "view.mode == 'monitors'">
    <tr>
      <th></th>
      <th class = "pid" >pid</th>
      <th class = "rate" >Monitor rate (sec)</th>
      <th class = "platform">platform 1</th>
      <th class = "pathStr">path</th>
      <th class = "platform">platform 2</th>
    </tr>
    <tr class = "monitor" ng-repeat="monitor in monitors | filter:view.platform1 | filter:view.platform2 as mList track by monitor.pid">
      <td> <button class = "rmButton" ng-click=rmFromMonitors(monitor)>x</button></td>
      <td class = "pid" >{{monitor.pid}}</td>
      <td class = "rate" ng-dblclick = "setMonitorRate(monitor)">{{monitor.rate}}</td>
      <td class = "platform">{{monitor.plat1}}</td>
      <td class = "pathStr">{{monitor.jsons}}</td>
      <td class = "platform">{{monitor.plat2}}</td>
    </tr>
</table>
`;
//*/

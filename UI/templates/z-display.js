var z_displayHTML = `
<table class="listContainer" ng-show = "view.mode == 'paths'">
    <tr>
      <th></th>
      <th class = "pid">pid</th>
      <th class = "platform">platform 1</th>
      <th class = "pathStr">path</th>
      <th class = "platform">platform 2</th>
    </tr>
    <tr class = "path zone" ng-repeat="(pid,path_obj) in masterList.paths">
      <td> <button class = "addButton" ng-click=addToMonitors(pid)>+</button></td>
      <td class = "platform">{{pid}}</td>
      <td class = "platform">{{path_obj.plat1}}</td>
      <td class = "pathStr">{{path_obj.str}}</td>
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
    <tr class = "monitor" ng-repeat="(pid,monitor) in masterList.monitors">
      <td> <button class = "rmButton" ng-click=rmFromMonitors(pid)>x</button></td>
      <td class = "pid" >{{pid}}</td>
      <td class = "rate" ng-click = "setMonitorRate(pid)">{{monitor.rate}}</td>
      <td class = "platform">{{monitor.plat1}}</td>
      <td class = "pathStr">{{monitor.str}}</td>
      <td class = "platform">{{monitor.plat2}}</td>
    </tr>
</table>
`;
//*/

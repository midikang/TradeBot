var z_filtersHTML = `
<select id = "pf1" class = "filter" ng-model="view.platform1" ng-options="x for x in platforms"></select>
<select id = "pf2" class = "filter" ng-model="view.platform2" ng-options="x for x in platforms"></select>
- Filters -
<input id = "af1" class = "filter" type="text" ng-model = "view.alias1" >
<input id = "af2" class = "filter" type="text" ng-model = "view.alias2" >
`;

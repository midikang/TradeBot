//angular stuff---------------------------------------------------------------
CTapp = angular.module("CustomTracker",[]);

CTapp.factory("ItemsManipulator",function(){                    //TODO TODO TODO TODO TODO
  var factory = {};

  factory.mode = "folders";
  factory.itemLists = {"folders":[],"forms":[],"records":null,"void":null};
  factory.cItemList= factory.itemLists.folders;
  factory.cform = undefined; // currFolder obj
  factory.cfolder = undefined; // currFolder obj
  factory.crecord = undefined; // currRecord obj
  factory.validModes = ["folders","records","forms","void"];

  factory.isValidType = function(type){
    return this.validModes.contains(type)
  }

  factory.setMode = function(mode){
    if (this.isValidType(mode)){
      this.mode = mode;

      this.cItemList = this.itemLists[mode];

    } else {
      alert("invalid mode: "+mode);
    }
  }

  factory.setCItem = function(type,item){
    if (type == "records"){
      this.crecord = item;
    } else if (type == "folders"){
      this.cfolder = item;
      this.itemLists.records = item.getRecords();
    } else if (type == "forms"){
      this.cform = item;
    } else {
      alert("setCItem() invalid type:"+type);
    }
  }

  factory.clearCRecord = function(){
    this.crecord = undefined;
  }

  factory.getFolderC = function(){
    return this.itemLists.folders.length;
  }

  factory.getFormC = function(){
    return this.itemLists.forms.length;
  }

  factory.deleteCItem = function(type){
    if (!isValidType(type)){
      alert("deleteCItem() invalid type: "+type);
      return;
    }

    /* mini secure check
    var randCode = "randomCode"; // replace with generator later
    var input = ctPrompt("Enter the following code to delete:"+randCode);

    if (!input || input !== randCode){
      alert("Invalid Code");
      return;
    }//*/

    if (type == "folders"){
      this.itemLists[type].remove(this.cfolder);
    } else if (type == "forms"){
      this.itemLists[type].remove(this.cform);
    } else if (type == "records"){
      this.itemLists[type].remove(this.crecord);
    }

    alert("Successfully deleted the record");
  }

  factory.getItemByTitle = function(type,title){
    var aList = this.itemLists[type];

    for (var i = 0; i < aList.length; i++) {
      if(aList[i].getTitle() == title){
        return aList[i];
      }
    }
    return null;
  }

  factory.itemExistsWithTitle = function(type,title){
    // alert("in itemExistsWithTitle() with: "+type+" "+title);
    return this.getItemByTitle(type,title) !== null;
  }

  return factory;
})
.factory("TabsSelector",function(){
  var factory = {};

  factory.selectedTab = "home";

  factory.selectTab = function(label){
    this.selectedTab = label;

    //*
    $(".selectedTab").removeClass("selectedTab");

    $("#"+label).addClass("selectedTab"); // change this to using databind on this.selectedTab */
  }

  return factory;
});

//alert("factory loaded");

PMapp = angular.module("PathManager",[]);

PMapp.factory("ViewSettings",function(){
  let factory = {};

  factory.platform1 = "";
  factory.platform2 = "";
  factory.alias1 = "";
  factory.alias2 = "";
  factory.alias3 = "";
  factory.alias4 = "";

  factory.mode = "paths";
  factory.changeMode = function(mode){
    if (["paths","monitors"].contains(mode)){
      this.mode = mode;
    } else {
      alert("ViewSettings.changeMode()\ngiven mode "+mode);
    }
  }

  return factory;
})/*
.factory("filters",function(){
  var factory = {};

  factory.selectedTab = "home";

  factory.selectTab = function(label){
    this.selectedTab = label;


    $(".selectedTab").removeClass("selectedTab");

    $("#"+label).addClass("selectedTab"); // change this to using databind on this.selectedTab
  }

  return factory;
})*/;

alert("factory loaded");

function strf(str,args){
  for (var i = 0; i  < args.length; i++) {
    str = str.replace('{}',args[i].toString());
  }
  return str;
}

function range(p1,p2){
  if (typeof p2 == "undefined"){
    p2 = p1;
    p1 = 0;
  }
  var lst = [];
  for (var i = p1; i < p2; i++) {
    lst.push(i);
  }
  return lst;
}

Array.prototype.contains = function(obj) {
    return this.indexOf(obj) !== -1;
}

Array.prototype.replace = function(oldItem,newItem) {
  var i = this.indexOf(oldItem);

  if (i > -1){
    this[i] = newItem;
  }
}

Array.prototype.remove = function(target) {
  var i = this.indexOf(target);

  if (i > -1){
    this.splice(i,1);
  }
}

Array.prototype.get = function(index) {
  if (index < 0){
    index = this.length + index;
  }
  return this[index];
}

Array.prototype.count = function(t){
  var c = 0;

  for (var i = 0; i < this.length; i++) {
    if (this[i] == t){
      c++;
    }
  }
  return c;
}

String.prototype.shorten = function(maxLength){
  if (this.length > maxLength + 3) {
    return this.substring(0,maxLength) + "...";
  } else {
    return this;
  }

}

function subString(s,begin, end){
  if (typeof end == "undefined"){
    end = s.length;
  }
  if(end < 0){
    return s.substring(begin,s.length+end);
  } else {
    return s.substring(begin,end);
  }
}

function radToDeg(r){
  return r*180/Math.PI;
}

function objToString(obj){
  var tmp = "";
  for (var i in obj) {
    if (obj.hasOwnProperty(i)){
      tmp+= strf("{}:\xa0\xa0\xa0\xa0{}\n",[i,obj[i]]); // the newline "\n" is for alert();
    }
  }
  return tmp;
}

var msgs = [];

function log(msg){
  msgs.push(msg.toString())
  alert(objToString(msgs));
}

function ctPrompt(promptMsg,defaultMsg){
  var promptAns = prompt(promptMsg,defaultMsg);

  if (promptAns.split("").count(" ") == promptAns.length || promptAns == null){
    return false; // invalid promptAns
  }

  return promptAns; // return valid promptAns
}

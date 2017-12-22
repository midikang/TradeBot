var timeUpdater;
var beganTiming = true;
var updateRate = 100;

function setUpdateRate(int newRate){
  if (newRate){
    stopTiming();
    updateRate = newRate;
    startTiming();
  }
}

function startTiming(){
  if (!beganTiming){
    beganTiming = true;
    timeUpdater = setInterval(updateTime, updateRate);
  }
}

function stopTiming(){
  if (beganTiming){
    beganTiming = false;
    clearInterval(timeUpdater);
  }
}

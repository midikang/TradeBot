<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>for testing purposes</title>
    <link rel="stylesheet" href="styles.css">

    <script src = "onlineScripts/jquery-2.2.4.js"></script>
    <script src = "onlineScripts/angular-1.6.4.js"></script>

    <?php include "php/finex.php";?>
    <?php //include "php/config.php";?>
  </head>


  <body class = "zone">
    <button onclick = "Pause()"> pause updating </button>
    <br><br>
    ask price: <a id = "askPrice" class = "yellowBG"></a>
    <br>
    bid price: <a id = "bidPrice" class = "yellowBG"></a>
    <br>
  </body>

  <script>
      <?php
      $getBTCUSD_info = json_decode(file_get_contents("https://api.bitfinex.com/v1/pubticker/BTCUSD"), true);
      ?>
      var crAsk = <?php echo $getBTCUSD_info['ask'];?>;
      $("#askPrice").html(crAsk);
      var crBid = <?php echo $getBTCUSD_info['bid'];?>;
      $("#bidPrice").html(crBid);

      var counter = 1;
      while(true){
        alert(counter);
        if (!(counter%3)){
          alert("reload now");
          Location.reload();
        }
        counter += 100;
      }
  </script>
</html>

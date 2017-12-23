<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>for testing purposes</title>
    <?php include "php/finex.php";?>
    <?php include "php/config.php";?>
  </head>


    <a class = "json_response">
      <?php
      echo $_GET['arg1'];
      echo $_GET['arg2'];
      ?>
    </a>

    <!--        Requests to be tested    >
    account_info()


    deposit($method, $wallet, $renew)
    transfer()
    margin_infos()
    fetch_balance()

    positions()
    claim_position($position_id, $amount)
    close_position($position_id)

    new_order($symbol, $amount, $price, $side, $type)
    cancel_order($order_id)
    cancel_all() <!---->

  </body>

</html>

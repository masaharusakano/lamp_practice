<?php header("X-FRAME-OPTIONS: DENY"); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴</title>
  <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'order.css')); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入履歴</h1>
  <div class="container">

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

  

        
      <?php if(count((array)$user_orders) > 0){ ?>
        <table class="table table-bordered">
          <tr>
            <th>注文番号</th>
            <th>購入日時</th>
            <th>購入金額</th>
            <th>明細</th>
          </tr>
          <?php foreach((array)$user_orders as $user_order){ ?>
          <tr>
            <td><?php print(h($user_order['order_id'])); ?></td>
            <td><?php print(h($user_order['created'])); ?></td>
            <td><?php print(h(number_format($user_order['total_price']))); ?>円</td>
            <td>
              <form action="details.php" method ="post">
                <input class="details_btn" type="submit" value="明細表示">
                <input type="hidden" name="order_id" value="<?php print (h($user_order['order_id'])); ?>">
              </form>  
            </td>
          </tr>
          <?php } ?>
        </table>
      <?php } else { ?>
        <p>購入履歴はありません。</p>
      <?php } ?> 

</body>
</html>
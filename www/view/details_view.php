<?php header("X-FRAME-OPTIONS: DENY"); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入明細</title>
  <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'details.css')); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入明細</h1>
  <div class="container">

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    
    <table class="table table-bordered">
      <tr>
        <th>注文番号</th>
        <th>購入日時</th>
        <th>購入金額</th>
      </tr>
      <tr>
        <td><?php print(h($user_order['order_id'])); ?></td>
        <td><?php print(h($user_order['created'])); ?></td>
        <td><?php print(h(number_format($user_order['total_price']))); ?>円</td>
      </tr>   
    </table>
    
    <table class="table table-bordered">
      <tr>
        <th>商品名</th>
        <th>価格</th>
        <th>購入数</th>
        <th>小計</th>
      </tr>
      <?php foreach($user_details as $user_detail){ ?>
      <tr>
        <td><?php print(h($user_detail['name'])); ?></td>
        <td><?php print(h($user_detail['price'])); ?>円</td>
        <td><?php print(h($user_detail['amount'])); ?></td>
        <td><?php print(h(number_format($user_detail['price'] * $user_detail['amount']))); ?>円</td>
      </tr>
      <?php } ?>
    </table>

</body>
</html>
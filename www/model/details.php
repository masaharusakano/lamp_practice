<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//特定のuser_idのカート内の情報取得
function get_user_details($db, $user_id){
  $sql = "
    SELECT
      details.details_id,
      details.order_id,
      details.item_id,
      details.amount,
      details.price
    FROM
      details
    WHERE
      carts.user_id = :user_id
  ";
  $params = array(':user_id' => $user_id);
  return fetch_all_query($db, $sql, $params);
}

//カートへ新規追加時の処理
function insert_details($db, $order_id, $item_id, $amount, $price){
  $sql = "
    INSERT INTO
      details(
        order_id,
        item_id,
        amount,
        price
      )
    VALUES(:order_id, :item_id, :amount, :price)
  ";
  $params = array(':order_id' => $order_id, ':item_id' => $item_id, ':amount' => $amount, ':price' => $price);
  return execute_query($db, $sql, $params);
}


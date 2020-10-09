<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//特定のuser_idのカート内の情報取得
function get_user_details($db, $order_id){
  $sql = "
    SELECT
      details.details_id,
      details.order_id,
      details.item_id,
      details.amount,
      details.price,
      `order`.user_id,
      `order`.total_price,
      `order`.created,
      items.name
    FROM
      details
    JOIN
      `order`
    ON
      details.order_id = `order`.order_id
    JOIN
      items
    ON
      details.item_id = items.item_id
    WHERE
      `order`.order_id = :order_id
  ";
  $params = array(':order_id' => $order_id);
  return fetch_all_query($db, $sql, $params);
}

function get_user_order($db, $order_id){
  $sql = "
    SELECT
      `order`.order_id,
      `order`.user_id,
      `order`.total_price,
      `order`.created
    FROM
      `order`
    WHERE
      `order`.order_id = :order_id
  ";
  $params = array(':order_id' => $order_id);
  return fetch_query($db, $sql, $params);
}

function sum_details($details){
  //小計金額の初期値
  $subtotal_price = 0;
  //小計金額の計算
  $subtotal_price += $details['price'] * $details['amount'];
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
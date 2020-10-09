<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//特定のuser_idの購入履歴情報取得
function get_user_orders($db, $user_id){
    $sql = "
      SELECT
        `order`.order_id,
        `order`.user_id,
        `order`.total_price,
        `order`.created
      FROM
        `order`
      WHERE
        `order`.user_id = :user_id
      ORDER BY
        created DESC
    ";
    $params = array(':user_id' => $user_id);
    return fetch_all_query($db, $sql, $params);
  }

//全てのuserの購入履歴情報取得
function get_all_user_orders($db, $user_id){
    $sql = "
      SELECT
        `order`.order_id,
        `order`.user_id,
        `order`.total_price,
        `order`.created
      FROM
        `order`
      ORDER BY
        created DESC
    ";
    return fetch_all_query($db, $sql);
}

//orderへ新規登録の処理
function insert_order($db, $user_id, $total_price){
    $sql = "
      INSERT INTO
        `order`(
          user_id,
          total_price
        )
      VALUES(:user_id, :total_price)
    ";
    $params = array(':user_id' => $user_id, ':total_price' => $total_price);
    return execute_query($db, $sql, $params);
  }
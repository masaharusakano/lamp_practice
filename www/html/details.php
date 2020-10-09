<?php
//関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'details.php';

// ログインチェックを行うため、セッションを開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === false){
  // ログインしていない場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

// PDOを取得
$db = get_db_connect();
// PDOを利用してログインユーザーのデータを取得
$user = get_login_user($db); 

$order_id = get_post('order_id');
//特定の購入履歴を取得
$user_details = get_user_details($db, $order_id);

$user_order = get_user_order($db, $order_id);

//カート内の合計金額の取得
$subtotal_price = sum_details($details);

//cart_view.phpを読み込み
include_once VIEW_PATH . 'details_view.php';
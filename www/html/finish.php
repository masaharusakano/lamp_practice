<?php
//関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

// ログインチェックを行うため、セッションを開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === false){
  // ログインしていない場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

$token = get_post('token');
//トークンチェック関数の利用
if(is_valid_csrf_token($token) === false){
  redirect_to(LOGIN_URL);
}
//トークンの破棄
unset($_SESSION['csrf_token'] );

// PDOを取得
$db = get_db_connect();
// PDOを利用してログインユーザーのデータを取得
$user = get_login_user($db);

//そのuser_idのカート情報を取得
$carts = get_user_carts($db, $user['user_id']);

//エラーチェック関数の利用
if(purchase_carts($db, $carts) === false){
  set_error('商品が購入できませんでした。');
  //カートページへリダイレクト
  redirect_to(CART_URL);
} 

//合計金額の取得
$total_price = sum_carts($carts);

//finish_view.phpを読み込み
include_once '../view/finish_view.php';
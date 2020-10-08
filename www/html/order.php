<?php
//関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'order.php';

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

//特定のuser_idの購入履歴を取得
$user_orders = get_user_orders($db, $user['user_id']);

//全てのuserの購入履歴を取得
$all_user_orders = get_all_user_orders($db, $user_id);

//cart_view.phpを読み込み
include_once VIEW_PATH . 'order_view.php';
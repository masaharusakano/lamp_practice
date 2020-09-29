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

//item_idの取得
$item_id = get_post('item_id');

//データベースの更新(カートへの商品追加)
if(add_cart($db,$user['user_id'], $item_id)){
  set_message('カートに商品を追加しました。');
} else {
  set_error('カートの更新に失敗しました。');
}

//ホームページへリダイレクト
redirect_to(HOME_URL);
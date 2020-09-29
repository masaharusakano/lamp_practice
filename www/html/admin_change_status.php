<?php
//関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

//ログインチェックを行うため、セッションを開始する。
session_start();

//ログインチェック用関数を利用
if(is_logined() === false){
  //ログインしていない場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

$token = get_post('token');
//トークンチェック関数の利用
if(is_valid_csrf_token($token) === false){
  redirect_to(LOGIN_URL);
}
//トークンの破棄
unset($_SESSION['csrf_token'] );

//PDOを取得
$db = get_db_connect();

//PDOを利用してログインユーザーのデータを取得
$user = get_login_user($db);

//ユーザー種別の確認
if(is_admin($user) === false){
  //管理者でなければログインページにリダイレクト
  redirect_to(LOGIN_URL);
}
//item_idの取得
$item_id = get_post('item_id');
//changes_toの取得
$changes_to = get_post('changes_to');

//openへ変更する場合
if($changes_to === 'open'){
  //データベースの更新
  update_item_status($db, $item_id, ITEM_STATUS_OPEN);
  set_message('ステータスを変更しました。');
//closeへ変更する場合
}else if($changes_to === 'close'){
  //データベースの更新
  update_item_status($db, $item_id, ITEM_STATUS_CLOSE);
  set_message('ステータスを変更しました。');
//どちらでもない場合
}else {
  set_error('不正なリクエストです。');
}

//adminページにリダイレクト
redirect_to(ADMIN_URL);
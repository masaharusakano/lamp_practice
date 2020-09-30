<?php
//関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

// ログインチェックを行うため、セッションを開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === true){
  // ログインしていない場合はログインページにリダイレクト
  redirect_to(HOME_URL);
}

$token = get_post('token');
//トークンチェック関数の利用
if(is_valid_csrf_token($token) === false){
  redirect_to(LOGIN_URL);
}
//トークンの破棄
unset($_SESSION['csrf_token'] );

//入力されたnameとpasswordの取得
$name = get_post('name');
$password = get_post('password');

// PDOを取得
$db = get_db_connect();

//存在検証関数の利用
$user = login_as($db, $name, $password);
if( $user === false){
  set_error('ログインに失敗しました。');
  redirect_to(LOGIN_URL);
}


set_message('ログインしました。');
//ユーザー種別の確認
if ($user['type'] === USER_TYPE_ADMIN){
  //管理者であればadminページへリダイレクト
  redirect_to(ADMIN_URL);
}
//そうでなければhomeページへリダイレクト
redirect_to(HOME_URL);
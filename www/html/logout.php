<?php
//関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';

// ログインチェックを行うため、セッションを開始する
session_start();
// セッション変数を全て削除
$_SESSION = array();
// sessionに関連する設定を取得
$params = session_get_cookie_params();
//cookieを無効化
setcookie(session_name(), '', time() - 42000,
  $params["path"], 
  $params["domain"],
  $params["secure"], 
  $params["httponly"]
);
// セッションIDを無効化
session_destroy();

//ログインページにリダイレクト
redirect_to(LOGIN_URL);


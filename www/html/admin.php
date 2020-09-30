<?php
//関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

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

//ユーザー種別の確認
if(is_admin($user) === false){
  //管理者でなければログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

//表示用のitem情報の取得
$items = get_all_items($db);

//トークンの生成
$token = get_csrf_token();
//admin_viewファイルの読み込み
include_once VIEW_PATH . '/admin_view.php';
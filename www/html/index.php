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

//ステータスがopenの場合、商品情報の取得
$items = get_open_items($db);

//ステータスがopenの商品の中でランキング情報取得
$items_ranking = get_open_items_ranking($db);
$ranking_number = 1;

//トークンの生成
$token = get_csrf_token();
//index_view.phpの読み込み
include_once VIEW_PATH . 'index_view.php';
<?php
//関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';

// ログインチェックを行うため、セッションを開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === true){
  // ログインしていない場合はログインページにリダイレクト
  redirect_to(HOME_URL);
}

//トークンの生成
$token = get_csrf_token();
//login_view.phpファイルの読み込み
include_once VIEW_PATH . 'login_view.php';
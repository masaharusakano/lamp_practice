<?php
//関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

// ログインチェックを行うため、セッションを開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === true){
  // ログインしていない場合はホームページにリダイレクト
  redirect_to(HOME_URL);
}

//入力されたname,password,password_confirmationの取得
$name = get_post('name');
$password = get_post('password');
$password_confirmation = get_post('password_confirmation');

// PDOを取得
$db = get_db_connect();

try{
  //エラーチェックの関数利用
  $result = regist_user($db, $name, $password, $password_confirmation);
  if( $result=== false){
    set_error('ユーザー登録に失敗しました。');
    //新規登録ページへリダイレクト
    redirect_to(SIGNUP_URL);
  }
}catch(PDOException $e){
  set_error('ユーザー登録に失敗しました。');
  redirect_to(SIGNUP_URL);
}

set_message('ユーザー登録が完了しました。');
//データベースへ新規登録
login_as($db, $name, $password);
//ホームページへリダイレクト
redirect_to(HOME_URL);
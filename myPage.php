<?php

require_once 'config/constants.php';
require_once 'model/User.php';
require_once 'utils/Utils.php';

// セッションが存在しない場合
if (session_status() === PHP_SESSION_NONE) {
    // セッションを開始する
    session_start();
}

// 未ログインの場合
if (!isset($_SESSION['userId'])) {
    // エラーメッセージと共にログイン画面に遷移
    $errorMessage = 'ログインしてください';
    header('Location: ' . BASE_DOMAIN . '/login.php');
    exit;
}

// ユーザーインスタンスを作成してセッション情報をセット
$user = new User();
$user->id = $_SESSION['userId'];

// TODO: [コントローラー]
// ユーザー情報を取得する
// $user = $user->getUserById();

// TODO: [モデル]
// getUserById():User
// あらかじめプロパティに設定されたuserIdを使って、Userを検索して返却してください
// PDOStatement::fetch() の引数にPDO::FETCH_CLASS を使うと良い感じかも。。

// マイページ画面を描画
Utils::loadView('マイページ', 'view/v_myPage.php');

<?php

require_once 'config/constants.php';
require_once 'model/User.php';
require_once 'utils/Utils.php';

// セッションが存在しない場合
if (session_status() === PHP_SESSION_NONE) {
    // セッションを開始する
    session_start();
}

// セッション・画面から渡された情報をサニタイズして変数に格納
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$stuttiId = isset($_POST['stutti-id']) ? Utils::e($_POST['stutti-id']) : null;
$password = isset($_POST['password']) ? Utils::e($_POST['password']) : null;

// ログイン済みの場合
if ($userId) {
    // セッションにメッセージを保存してマイページ画面に遷移
    $_SESSION['message'] = 'すでにログインしています';
    header('Location: ' . BASE_DOMAIN . '/myPage.php');
    exit;
}

// ヘッダーのログインボタンが押下された場合
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ログイン画面を描画
    Utils::loadView('ログイン', 'view/v_login.php');

// ログイン画面のログインボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ユーザーインスタンスを作成して画面から渡された情報をセット
    $user = new User();
    $user->setStuttiId($stuttiId);
    $user->setPassword($password);

    // ログイン試行
    // ログインに成功した場合
    if ($user->login()) {
        // セッションにユーザーIDを保存してマイページ画面に遷移
        $_SESSION['userId'] = $user->getId();
        header('Location: ' . BASE_DOMAIN . '/myPage.php');

    // ログインに失敗した場合
    } else {
        // セッションにメッセージを保存してログイン画面を再描画
        $_SESSION['message'] = 'Stutti ID かパスワードが異なります';
        Utils::loadView('ログイン', 'view/v_login.php');
    }
}
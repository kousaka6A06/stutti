<?php

require_once 'config/constants.php';
require_once 'model/User.php';
require_once 'utils/Utils.php';

// セッションが存在しない場合
if (session_status() === PHP_SESSION_NONE) {
    // セッションを開始する
    session_start();
}

// ログイン済みの場合
if (isset($_SESSION['userId'])) {
    // マイページ画面に遷移
    header('Location: ' . BASE_DOMAIN . '/mypage.php');
    exit;
}

// ヘッダーのログインボタンが押下された場合
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ログイン画面を描画
    Utils::loadView('ログイン', 'view/v_login.php');

// ログイン画面でログインボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ユーザーインスタンスを作成して画面で入力された内容をセット
    $user = new User();
    $user->login_id = $_POST['login-id'];
    $user->password = $_POST['password'];

    // ログイン試行
    // ログインに成功した場合
    if ($user->login()) {
        // セッションにユーザーIDを保存してマイページ画面に遷移
        $_SESSION['userId'] = $user->id;
        header('Location: ' . BASE_DOMAIN . '/mypage.php');

    // ログインに失敗した場合
    } else {
        // エラーメッセージと共にログイン画面を再描画
        $errorMessage = 'Stutti ID かパスワードが異なります';
        Utils::loadView('ログイン', 'view/v_login.php');
    }
}
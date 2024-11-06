<?php

require_once 'config/constants.php';

// セッションが存在しない場合
if (session_status() === PHP_SESSION_NONE) {
    // セッションを開始する
    session_start();
}

// セッション変数を全て解除する
$_SESSION = array();

// セッションクッキーを削除する
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// セッションを破壊する
session_destroy();

// セッションにメッセージを保存してログイン画面に遷移
$_SESSION['message'] = 'ログアウトしました';
header('Location: ' . BASE_DOMAIN . '/login.php');
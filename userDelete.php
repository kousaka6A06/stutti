<?php

require_once 'config/constants.php';
require_once 'model/User.php';
require_once 'utils/Utils.php';

// セッションが存在しない場合
if (session_status() === PHP_SESSION_NONE) {
    // セッションを開始する
    session_start();
}

// セッションから渡された情報を変数に格納
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

// 未ログインの場合
if (!$userId) {
    // セッションにメッセージを保存してログイン画面に遷移
    $_SESSION['message'] = 'ユーザーを削除したい場合はログインしてください';
    header('Location: ' . BASE_DOMAIN . '/login.php');
    exit;
}

// ユーザーインスタンスを作成してセッション情報をセット
$user = new User();
$user->setId($userId);

// ユーザー削除試行
// ユーザー削除に成功した場合
if ($user->deleteUser()) {
    // セッションからユーザーIDを破棄
    unset($_SESSION['userId']);

    // セッションにメッセージを保存してトップ画面に遷移
    $_SESSION['message'] = 'ユーザーを削除しました';
    header('Location: ' . BASE_DOMAIN . '/index.php');

// ユーザー削除に失敗した場合
} else {
    // セッションにメッセージを保存してエラー画面に遷移
    $_SESSION['message'] = 'ユーザーの削除に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
    header('Location: ' . BASE_DOMAIN . '/error.php');
}
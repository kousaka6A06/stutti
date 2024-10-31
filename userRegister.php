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

// ヘッダーのユーザー登録ボタンが押下された場合
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ユーザー登録画面を描画
    Utils::loadView('ユーザー登録', 'view/v_userRegister.php');

// ユーザー登録画面でユーザー登録ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ユーザーインスタンスを作成して画面で入力された内容をセット
    $user = new User();
    $user->login_id = $_POST['login-id'];
    $user->password = $_POST['password'];
    $user->name = $_POST['name'];
    $user->mail_address = $_POST['mail-address'];
    if (isset($_POST['avatar'])) {
        $user->avatar = $_POST['avatar'];
    } else {
        $user->avatar = DEFAULT_AVATAR;
    }

    // ユーザー登録試行
    // ユーザー登録に成功した場合
    if ($user->createUser()) {
        // セッションにユーザーIDを保存してマイページ画面に遷移
        $_SESSION['userId'] = $user->id;
        header('Location: ' . BASE_DOMAIN . '/mypage.php');

    // ユーザー登録に失敗した場合
    } else {
        // エラーメッセージと共にエラー画面を描画
        $errorMessage = 'ユーザーの作成に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
        Utils::loadView('エラー', 'view/v_error.php');
    }
}
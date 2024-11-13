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
$password = isset($_POST['password']) ? Utils::e($_POST['password']) : null;
$name = isset($_POST['name']) ? Utils::e($_POST['name']) : null;
$mailAddress = isset($_POST['mail-address']) ? Utils::e($_POST['mail-address']) : null;
$avatar = isset($_POST['avatar']) ? Utils::e($_POST['avatar']) : null;

// 未ログインの場合
if (!$userId) {
    // セッションにメッセージを保存してログイン画面に遷移
    $_SESSION['message'] = 'ユーザーを編集したい場合はログインしてください';
    header('Location: ' . BASE_DOMAIN . '/login.php');
    exit;
}

// マイページ画面の編集ボタンが押下された場合
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ユーザーインスタンスを作成してセッション情報をセット
    $user = new User();
    $user->setId($userId);

    // TODO: [コントローラー]
    // ユーザー情報を取得する
    // $user = $user->getUserById();

    // ユーザー編集画面を描画
    Utils::loadView('ユーザー編集', 'view/v_userEdit.php');

// ユーザー編集画面の修正ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ユーザーインスタンスを作成して画面から渡された情報をセット
    $user = new User();
    $user->setPassword($password);
    $user->setName($name);
    $user->setMailAddress($mailAddress);
    if ($avatar) {
        $user->setAvatar($avatar);
    } else {
        $user->setAvatar(DEFAULT_AVATAR);
    }

    // ユーザー編集試行
    // ユーザー編集に成功した場合
    if ($user->updateUser()) {
        // セッションにメッセージを保存してマイページ画面に遷移
        $_SESSION['message'] = 'ユーザーを編集しました';
        header('Location: ' . BASE_DOMAIN . '/mypage.php');

    // ユーザー編集に失敗した場合
    } else {
        // セッションにメッセージを保存してエラー画面に遷移
        $_SESSION['message'] = 'ユーザーの編集に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
        header('Location: ' . BASE_DOMAIN . '/error.php');
    }
}
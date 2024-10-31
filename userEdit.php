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

// マイページ画面の編集ボタンが押下された場合
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ユーザーインスタンスを作成してセッション情報をセット
    $user = new User();
    $user->id = $_SESSION['userId'];

    // TODO: [コントローラー]
    // ユーザー情報を取得する
    // $user = $user->getUserById();

    // ユーザー編集画面を描画
    Utils::loadView('ユーザー編集', 'view/v_userEdit.php');

// ユーザー編集画面で修正ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ユーザーインスタンスを作成して画面で入力された内容をセット
    $user = new User();
    $user->password = $_POST['password'];
    $user->name = $_POST['name'];
    $user->mail_address = $_POST['mail-address'];
    if (isset($_POST['avatar'])) {
        $user->avatar = $_POST['avatar'];
    } else {
        $user->avatar = DEFAULT_AVATAR;
    }

    // ユーザー編集試行
    // ユーザー編集に成功した場合
    if ($user->editUser()) {

    // TODO: [モデル]
    // editUser():bool
    // あらかじめプロパティに設定されたユーザー情報で、UsersレコードをUPDATEしてください
    // PDOStatement::execute()の戻り値(true or false)をそのまま返却してください

        // マイページ画面に遷移
        header('Location: ' . BASE_DOMAIN . '/mypage.php');

    // ユーザー編集に失敗した場合
    } else {
        // エラーメッセージと共にエラー画面を描画
        $errorMessage = 'ユーザーの編集に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
        Utils::loadView('エラー', 'view/v_error.php');
    }
}
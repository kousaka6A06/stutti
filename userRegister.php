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

// ユーザー登録画面のユーザー登録ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ユーザーインスタンスを作成して画面から渡された情報をセット
    $user = new User();
    $user->setStuttiId($_POST['stutti-id']);
    $user->setPassword($_POST['password']);
    $user->setName($_POST['name']);
    $user->setMailAddress($_POST['mail-address']);
    if (isset($_POST['avatar'])) {
        $user->setAvatar($_POST['avatar']);
    } else {
        $user->setAvatar(DEFAULT_AVATAR);
    }

    // ユーザー登録試行
    // ユーザー登録に成功した場合
    if ($user->createUser()) {

    // TODO: [モデル]
    // createUser():bool
    // あらかじめプロパティに設定されたユーザー情報で、Usersレコードを作成してください
    // レコード作成後、下記プログラムを実行して自動採番されたidをインスタンスに設定しておいてください
    // $this->id = $this->conn->lastInsertId();

        // セッションにユーザーIDを保存してマイページ画面に遷移
        $_SESSION['userId'] = $user->getId();
        header('Location: ' . BASE_DOMAIN . '/mypage.php');

    // ユーザー登録に失敗した場合
    } else {
        // エラーメッセージと共にエラー画面を描画
        $errorMessage = 'ユーザーの作成に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
        Utils::loadView('エラー', 'view/v_error.php');
    }
}
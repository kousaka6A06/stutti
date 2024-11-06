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
$name = isset($_POST['name']) ? Utils::e($_POST['name']) : null;
$mailAddress = isset($_POST['mail-address']) ? Utils::e($_POST['mail-address']) : null;
$avatar = isset($_POST['avatar']) ? Utils::e($_POST['avatar']) : null;

// ログイン済みの場合
if ($userId) {
    // セッションにメッセージを保存してマイページ画面に遷移
    $_SESSION['message'] = 'ログイン済みです';
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
    $user->setStuttiId($stuttiId);
    $user->setPassword($password);
    $user->setName($name);
    $user->setMailAddress($mailAddress);
    if ($avatar) {
        $user->setAvatar($avatar);
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

        // セッションにユーザーID・メッセージを保存してマイページ画面に遷移
        $_SESSION['userId'] = $user->getId();
        $_SESSION['message'] = 'ユーザーを作成しました';
        header('Location: ' . BASE_DOMAIN . '/mypage.php');

    // ユーザー登録に失敗した場合
    } else {
        // セッションにメッセージを保存してエラー画面に遷移
        $_SESSION['message'] = 'ユーザーの作成に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
        header('Location: ' . BASE_DOMAIN . '/error.php');
    }
}
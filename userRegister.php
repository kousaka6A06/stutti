<?php

require_once 'config/constants.php';
require_once 'model/User.php';
require_once 'utils/Utils.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_DOMAIN . '/mypage.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    Utils::loadView('会員登録', 'view/v_userRegister.php');

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $user->login_id = $_POST['login-id'];
    $user->password = $_POST['password'];
    $user->name = $_POST['name'];
    $user->mail_address = $_POST['mail-address'];
    $user->avatar = $_POST['avatar'];

    if ($user->createUser()) {
        $_SESSION['user_id'] = $user->id;
        header('Location: ' . BASE_DOMAIN . '/mypage.php');

    } else {
        $error_message = 'ユーザーの作成に失敗しました';
        Utils::loadView('エラー', 'view/v_error.php');
    }
}
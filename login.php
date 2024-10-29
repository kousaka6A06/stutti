<?php

require_once 'config/constants.php';
require_once 'model/User.php';
require_once 'utils/Utils.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_DOMAIN . '/mypage.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    Utils::loadView('ログイン', 'view/v_login.php');

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $user->login_id = $_POST['login-id'];
    $user->password = $_POST['password'];

    if ($user->login()) {
        $_SESSION['user_id'] = $user->id;
        header('Location: ' . BASE_DOMAIN . '/mypage.php');

    } else {
        $error_message = 'ログインID かパスワードが異なります';
        Utils::loadView('ログイン', 'view/v_login.php');
    }
}
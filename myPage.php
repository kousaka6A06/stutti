<?php

require_once 'config/constants.php';
require_once 'model/Group.php';
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
    $_SESSION['message'] = 'マイページを表示したい場合はログインしてください';
    header('Location: ' . BASE_DOMAIN . '/login.php');
    exit;
}

// ユーザーインスタンスを作成してセッション情報をセット
$user = new User();
$user->setId($userId);

// ユーザー情報を取得する
$user = $user->getUserById();

// 勉強会インスタンスを作成
$group = new Group();

// 作成した勉強会情報取得
$ownerGroups = $group->getGroupsByOwnerId($user['id']);

// 参加中の勉強会情報取得
$memberGroups = $group->getGroupsByMemberId($user['id']);

// マイページ画面を描画
Utils::loadView('マイページ', 'view/v_myPage.php');
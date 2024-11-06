<?php

require_once 'config/constants.php';
require_once 'model/Group.php';
require_once 'model/User.php';

// セッションが存在しない場合
if (session_status() === PHP_SESSION_NONE) {
    // セッションを開始する
    session_start();
}

// セッション・画面から渡された情報をサニタイズして変数に格納
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$groupId = isset($_GET['gid']) ? Utils::e($_GET['gid']) : null;

// 勉強会IDが指定されていない場合
if (!$groupId) {
    // 勉強会一覧画面に遷移
    header('Location: ' . BASE_DOMAIN . '/groupList.php');
    exit;
}

// 未ログインの場合
if (!isset($userId)) {
    // セッションにメッセージを保存してログイン画面に遷移
    $_SESSION['message'] = 'ログインしてください';
    header('Location: ' . BASE_DOMAIN . '/login.php');
    exit;
}

// 勉強会インスタンスを作成して画面から渡された情報をセット
$group = new Group();
$group->setId($groupId);

// TODO: [コントローラー]
// 勉強会情報取得
// $group = $group->getGroupById();

// 勉強会の定員に余裕がある場合
// if (!$group->isFull()) {
    // ユーザーインスタンスを作成してセッション情報をセット
    $user = new User();
    $user->setId($userId);

    // TODO: [コントローラー]
    // ユーザー情報を取得する
    // $user = $user->getUserById();

    // TODO: [コントローラー]
    // メンバー登録試行
    // メンバー登録に成功した場合
    // if ($group->addMember($user->getId())) {

    // TODO: [モデル]
    // addMember($userId):boolean
    // 引数で渡されたユーザーをグループに追加してください
    // 実行結果の成否を返却してください

    // メンバー登録に失敗した場合
    // } else {
        // セッションにメッセージを保存してエラー画面に遷移
        // $_SESSION['message'] = 'メンバー登録に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
        // header('Location: ' . BASE_DOMAIN . '/error.php');
    // }

// 勉強会が満員の場合
// } else {
    // セッションにメッセージを保存して勉強会詳細画面に遷移
    // $_SESSION['message'] = '満員のため勉強会に参加できません。';
    // header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);
// }

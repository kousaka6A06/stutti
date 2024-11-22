<?php

require_once 'config/constants.php';
require_once 'model/Belonging.php';
require_once 'model/Group.php';
require_once 'model/User.php';
require_once 'utils/Utils.php';

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
if (!$userId) {
    // セッションにメッセージを保存して勉強会詳細画面に遷移
    $_SESSION['message'] = '勉強会から退会したい場合はログインしてください';
    header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);
    exit;
}

// 勉強会参加者インスタンスを作成してセッション情報をセット
$belonging = new Belonging();
$belonging->setMemberId($userId);
$belonging->setGroupId($groupId);

// 勉強会の参加者ではない場合
if (!$belonging->isMemberOfGroup()) {
    // セッションにメッセージを保存して勉強会詳細画面に遷移
    $_SESSION['message'] = '勉強会に参加していないため退会できません';
    header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);
    exit;
}

// TODO:
// 勉強会退会試行
// 勉強会退会に成功した場合
// if ($belonging->removeMember()) {
    // セッションにメッセージを保存して勉強会詳細画面に遷移
    $_SESSION['message'] = '勉強会から退会しました（★実装中です★）';
    header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);

// // 勉強会退会に失敗した場合
// } else {
//     // セッションにメッセージを保存してエラー画面に遷移
//     $_SESSION['message'] = '勉強会のからの退会に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
//     header('Location: ' . BASE_DOMAIN . '/error.php');
// }
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
    $_SESSION['message'] = '勉強会を削除したい場合はログインしてください';
    header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);
    exit;
}

// ユーザーインスタンスを作成してセッション情報をセット
$user = new User();
$user->setId($userId);

// TODO: [コントローラー]
// 勉強会の作成者ではない場合
// if (!$user->isOwnerOfGroup($groupId)) {
//     // セッションにメッセージを保存して勉強会詳細画面に遷移
//     $_SESSION['message'] = '勉強会を削除する権限がありません';
//     header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);
//     exit;
// }

// 勉強会インスタンスを作成して画面から渡された情報をセット
$group = new Group();
$group->setId($groupId);

// 勉強会削除試行
// 勉強会削除に成功した場合
if ($group->deleteGroup()) {
    // セッションにメッセージを保存して勉強会一覧画面に遷移
    $_SESSION['message'] = '勉強会を削除しました';
    header('Location: ' . BASE_DOMAIN . '/groupList.php');

// 勉強会削除に失敗した場合
} else {
    // セッションにメッセージを保存してエラー画面に遷移
    $_SESSION['message'] = '勉強会削除に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
    header('Location: ' . BASE_DOMAIN . '/error.php');
}
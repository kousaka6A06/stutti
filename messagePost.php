<?php

require_once 'config/constants.php';
require_once 'model/GroupMessage.php';
require_once 'utils/Utils.php';

// セッションが存在しない場合
if (session_status() === PHP_SESSION_NONE) {
    // セッションを開始する
    session_start();
}

// セッション・画面から渡された情報をサニタイズして変数に格納
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$groupId = isset($_POST['gid']) ? Utils::e($_POST['gid']) : null;
$content = isset($_POST['content']) ? Utils::e($_POST['content']) : null;

// 勉強会IDが指定されていない場合
if (!$groupId) {
    // 勉強会一覧画面に遷移
    header('Location: ' . BASE_DOMAIN . '/groupList.php');
    exit;
}

// 未ログインの場合
if (!$userId) {
    // セッションにメッセージを保存して勉強会詳細画面に遷移
    $_SESSION['message'] = 'メッセージを投稿したい場合はログインしてください';
    header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);
    exit;
}

// 勉強会メッセージインスタンスを作成して画面から渡された情報をセット
$message = new GroupMessage();
$message->setGroupId($groupId);
$message->setMemberId($userId);
$message->setContent($content);

// 勉強会メッセージ投稿試行
// 勉強会メッセージ投稿に成功した場合
if ($message->createGroupMessage()) {
    // セッションにメッセージを保存して勉強会詳細画面に遷移
    $_SESSION['message'] = 'メッセージを投稿しました';
    header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);

// 勉強会メッセージ投稿に失敗した場合
} else {
    // セッションにメッセージを保存してエラー画面に遷移
    $_SESSION['message'] = 'メッセージの投稿に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
    header('Location: ' . BASE_DOMAIN . '/error.php');
}

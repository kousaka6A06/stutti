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
$messageId = isset($_POST['mid']) ? Utils::e($_POST['mid']) : null;

// 勉強会IDが指定されていない場合
if (!$groupId) {
    // 勉強会一覧画面に遷移
    header('Location: ' . BASE_DOMAIN . '/groupList.php');
    exit;
}

// 勉強会メッセージIDが指定されていない場合
if (!$messageId) {
    // 勉強会詳細画面に遷移
    header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);
    exit;
}

// 未ログインの場合
if (!$userId) {
    // セッションにメッセージを保存して勉強会詳細画面に遷移
    $_SESSION['message'] = 'メッセージを削除したい場合はログインしてください';
    header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);
    exit;
}

// 勉強会メッセージインスタンスを作成して画面から渡された情報をセット
$message = new GroupMessage();
$message->setId($messageId);

// 勉強会メッセージ情報を取得する
$message = $message->getGroupMessageById();

// 勉強会メッセージの作成者ではない場合
if ($message['memberId'] !== $userId) {
    // セッションにメッセージを保存して勉強会詳細画面に遷移
    $_SESSION['message'] = 'メッセージを削除する権限がありません';
    header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);
    exit;
}

// 勉強会メッセージ削除試行
// 勉強会メッセージ削除に成功した場合
if ($message->deleteGroupMessage()) {
    // セッションにメッセージを保存して勉強会詳細画面に遷移
    $_SESSION['message'] = 'メッセージを削除しました';
    header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);

// 勉強会メッセージ削除に失敗した場合
} else {
    // セッションにメッセージを保存してエラー画面に遷移
    $_SESSION['message'] = 'メッセージの削除に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
    header('Location: ' . BASE_DOMAIN . '/error.php');
}
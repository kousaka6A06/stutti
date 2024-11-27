<?php

require_once 'config/constants.php';
require_once 'model/TuttiComment.php';
require_once 'utils/Utils.php';

// 画面から渡された情報をサニタイズして変数に格納
$name = isset($_POST['name']) ? Utils::e($_POST['name']) : null;
$content = isset($_POST['content']) ? Utils::e($_POST['content']) : null;
$tuttiId = isset($_POST['tid']) ? Utils::e($_POST['tid']) : null;

// tuttiIDが指定されていない場合
if (!$tuttiId) {
    // トップ画面に遷移
    header('Location: ' . BASE_DOMAIN . '/index.php');
    exit;
}

// tuttiコメントインスタンスを作成して画面から渡された情報をセット
$comment = new TuttiComment();
$comment->setName($name);
$comment->setContent($content);
$comment->setTuttiId($tuttiId);

// tuttiコメント投稿試行
// tuttiコメント投稿に成功した場合
if ($comment->createTuttiComment()) {
    // セッションにメッセージを保存してtutti詳細画面に遷移
    $_SESSION['message'] = 'コメントを投稿しました';
    header('Location: ' . BASE_DOMAIN . '/tutti.php?tid=' . $tuttiId);

// tuttiコメント投稿に失敗した場合
} else {
    // セッションにメッセージを保存してエラー画面に遷移
    $_SESSION['message'] = 'コメントの投稿に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
    header('Location: ' . BASE_DOMAIN . '/error.php');
}
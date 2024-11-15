<?php

require_once 'config/constants.php';
require_once 'model/Group.php';
require_once 'model/MTutti.php';
require_once 'model/TuttiComment.php';
require_once 'utils/Utils.php';

// 画面から渡された情報をサニタイズして変数に格納
$tuttiId = isset($_GET['tid']) ? Utils::e($_GET['tid']) : null;

// tuttiIDが指定されていない場合
if (!$tuttiId) {
    // トップ画面に遷移
    header('Location: ' . BASE_DOMAIN . '/index.php');
    exit;
}

// tuttiインスタンスを作成して画面から渡された情報をセット
$tutti = new MTutti();
$tutti->setId($tuttiId);

// tutti情報取得
$tuttiInfo = $tutti->getTuttiById();

// tutti所属の勉強会情報取得
$group = new Group();
$group->setTuttiId($tuttiId);
$groupInfos = $group->getGroupsByTuttiId();

// tuttiコメントインスタンスを作成して画面から渡された情報をセット
$comment = new TuttiComment();
$comment->setTuttiId($tuttiId);

// tuttiコメント情報取得
$commentInfos = $comment->getTuttiCommentsByTuttiId();

// tutti詳細画面を描画
Utils::loadView('tutti詳細', 'view/v_tutti.php');
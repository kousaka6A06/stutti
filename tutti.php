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

// TODO: [コントローラー]
// tutti情報取得
// $tutti = $tutti->getTuttiById();

// TODO: [モデル]
// getTuttiById():Group
// あらかじめプロパティに設定されたtuttiIDを使って、tuttiを検索して返却してください

// TODO: [コントローラー]
// tutti所属の勉強会情報取得
$group = new Group();
// $groups = $group->getGroupsByTuttiId($tuttiId);

// TODO: [モデル]
// getGroupsByTuttiId():Group[]
// 引数で渡されたtuttiIDを使って、tuttiに所属するGroupを検索して返却してください

// tuttiコメントインスタンスを作成して画面から渡された情報をセット
$comment = new TuttiComment();
$comment->setTuttiId($tuttiId);

// TODO: [コントローラー]
// tuttiコメント情報取得
// $comments = $comment->getTuttiCommentsByTuttiId();

// TODO: [モデル]
// getTuttiCommentsByTuttiId():TuttiComment[]
// あらかじめプロパティに設定されたtuttiIDを使って、TuttiCommentを検索してオブジェクトの配列で返却してください

// tutti詳細画面を描画
Utils::loadView('tutti詳細', 'view/v_tutti.php');
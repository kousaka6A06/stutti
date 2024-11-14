<?php

require_once 'config/constants.php';
require_once 'model/Group.php';
require_once 'model/GroupMessage.php';
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

// 勉強会インスタンスを作成して画面から渡された情報をセット
$group = new Group();
$group->setId($groupId);

// 勉強会情報取得
$group = $group->getGroupById();

// 画面表示制御用にステータス設定
$userStatus = null;
$groupStatus = null;

// 未ログインの場合
if (!$userId) {
    $userStatus = NOT_LOGGED_IN;

// ログイン済みの場合
} else {
    // ユーザーインスタンスを作成してセッション情報をセット
    $user = new User();
    $user->setId($userId);

    // ユーザー情報を取得する
    $user = $user->getUserById();

    // TODO: [コントローラー]
    // 勉強会に未参加の場合
    // if (!$user->isMemberOfGroup($groupId)) {

    // TODO: [モデル]
    // isMemberOfGroup($groupId):boolean
    // このユーザーインスタンスが、引数で渡された勉強会の参加者かどうかをbooleanで返却してください

        $userStatus = LOGGED_IN;

        // 勉強会が満員の場合
        if ($group->isFull()) {
            $groupStatus = FULL;

        // 勉強会の定員に余裕がある場合
        } else {
            $groupStatus = NOT_FULL;
        }

    // 勉強会に参加中の場合
    // } else {
        // 勉強会メッセージを作成して画面から渡された情報をセット
        $message = new GroupMessage();
        $message->setGroupId($groupId);

        // 勉強会メッセージ情報取得
        $messages = $message->getGroupMessagesByGroupId();

        // 勉強会の作成者の場合
        if ($user->isOwnerOfGroup($groupId)) {
            $userStatus = GROUP_OWNER;
    
        // 作成者ではない場合
        } else {
            $userStatus = GROUP_MEMBER;
        }
    // }
}

// 勉強会詳細画面を描画
Utils::loadView('勉強会詳細', 'view/v_groupDetail.php');
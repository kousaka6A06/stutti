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

// 勉強会IDが指定されていない場合
if (!isset($_GET['gid'])) {
    // 勉強会一覧画面に遷移
    header('Location: ' . BASE_DOMAIN . '/groupList.php');
}

// 勉強会インスタンスを作成して画面から渡された情報をセット
$group = new Group();
$group->setId($_GET['gid']);

// TODO: [コントローラー]
// 勉強会情報取得
// $group = $group->getGroupById();

// TODO: [モデル]
// getGroupById():Group
// あらかじめプロパティに設定されたgroupIdを使って、Groupを検索して返却してください
// PDOStatement::fetch() の引数にPDO::FETCH_CLASS を使うと良い感じかも。。

// 参加ボタンが押下された場合
// if (isset($_POST['participate'])) {
    // 勉強会の定員に余裕がある場合
    // if (!$group->isFull()) {
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
            // エラーメッセージと共にエラー画面を描画
            // $errorMessage = 'メンバー登録に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
            // Utils::loadView('エラー', 'view/v_error.php');
            // exit;
        // }

    // 勉強会が満員の場合
    // } else {
        // エラーメッセージを設定
        // $errorMessage = '満員のため勉強会に参加できません。';
    // }
// }

// 画面表示制御用にステータス設定
$userStatus = null;
$groupStatus = null;

// 未ログインの場合
if (!isset($_SESSION['user'])) {
    $userStatus = NOT_LOGGED_IN;

// ログイン済みの場合
} else {
    // ユーザーインスタンスをセッションから取得
    $user = $_SESSION['user'];

    // 勉強会に未参加の場合
    if (!$user->isMemberOfGroup($_GET['gid'])) {

    // TODO: [モデル]
    // isMemberOfGroup($groupId):boolean
    // このユーザーインスタンスが、引数で渡された勉強会の参加者かどうかをbooleanで返却してください

        $userStatus = LOGGED_IN;

        // 勉強会が満員の場合
        // if ($group->isFull()) {
            // $groupStatus = FULL;

        // 勉強会の定員に余裕がある場合
        // } else {
            $groupStatus = NOT_FULL;
        // }

    // 勉強会に参加中の場合
    } else {
        // 勉強会メッセージを作成して画面から渡された情報をセット
        $message = new GroupMessage();
        $message->setGroupId($_GET['gid']);

        // TODO: [コントローラー]
        // 勉強会メッセージ情報取得
        // $messages = $message->getGroupMessagesByGroupId();

        // TODO: [モデル]
        // getGroupMessagesByGroupId():GroupMessage[]
        // あらかじめプロパティに設定されたgroupIdを使って、GroupMessageを検索してオブジェクトの配列で返却してください
        // PDOStatement::fetch() の引数にPDO::FETCH_CLASS を使うと良い感じかも。。

        // TODO: [コントローラー]
        // 勉強会の作成者の場合
        // if ($user->isOwnerOfGroup($_GET['gid'])) {

        // TODO: [モデル]
        // isOwnerOfGroup($groupId):boolean
        // このユーザーインスタンスが、引数で渡された勉強会の作成者かどうかをbooleanで返却してください
    
            $userStatus = GROUP_OWNER;
    
        // 作成者ではない場合
        // } else {
            // $userStatus = GROUP_MEMBER;
        // }
    }
}

// 勉強会詳細画面を描画
Utils::loadView('勉強会詳細', 'view/v_groupDetail.php');
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
$name = isset($_POST['name']) ? Utils::e($_POST['name']) : null;
$date = isset($_POST['date']) ? Utils::e($_POST['date']) : null;
$time = isset($_POST['time']) ? Utils::e($_POST['time']) : null;
$location = isset($_POST['location']) ? Utils::e($_POST['location']) : null;
$numPeople = isset($_POST['num-people']) ? Utils::e($_POST['num-people']) : null;
$content = isset($_POST['content']) ? Utils::e($_POST['content']) : null;
$tuttiId = isset($_POST['tutti-id']) ? Utils::e($_POST['tutti-id']) : null;

// 未ログインの場合
if (!$userId) {
    // セッションにメッセージを保存してログイン画面に遷移
    $_SESSION['message'] = 'ログインしてください';
    header('Location: ' . BASE_DOMAIN . '/login.php');
    exit;
}

// ヘッダーの勉強会作成ボタンが押下された場合
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !$groupId) {
    // 勉強会作成画面を描画
    Utils::loadView('勉強会作成', 'view/v_groupEdit.php');

// 勉強会詳細画面の編集ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $groupId) {
    // TODO: [コントローラー]
    // 勉強会の作成者以外が直接アクセスしてきた場合
    // if (!$user->isOwnerOfGroup($groupId)) {
        // セッションにメッセージを保存して勉強会詳細画面に遷移
        // $_SESSION['message'] = '作成者以外は勉強会を編集できません';
        // header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);

    // 勉強会の作成者の場合
    // } else {
        // 勉強会インスタンスを作成して画面から渡された情報をセット
        $group = new Group();
        $group->setId($groupId);

        // TODO: [コントローラー]
        // 勉強会情報取得
        // $group = $group->getGroupById();

        // 勉強会編集画面を描画
        Utils::loadView('勉強会編集', 'view/v_groupEdit.php');
    // }

// 勉強会作成・編集画面の登録ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 勉強会インスタンスを作成して画面から渡された情報をセット
    $group = new Group();
    $group->setName($name);
    $group->setDate($date);
    $group->setTime($time);
    $group->setLocation($location);
    $group->setNumPeople($numPeople);
    $group->setContent($content);
    $group->setTuttiId($tuttiId);
    $group->setCreatedById($userId);

    // 勉強会作成画面の場合
    if (!$groupId) {
        // TODO: [コントローラー]
        // 勉強会登録試行
        // 勉強会登録に成功した場合
        // if ($group->createGroup()) {

        // TODO: [モデル]
        // createGroup():bool
        // あらかじめプロパティに設定された勉強会情報で、Groupsレコードを作成してください
        // レコード作成後、下記プログラムを実行して自動採番されたidをインスタンスに設定しておいてください
        // ⇒ $this->id = $this->conn->lastInsertId();
        // 実行結果の成否を返却してください

            // セッションにメッセージを保存して勉強会詳細画面に遷移
            $_SESSION['message'] = '勉強会を作成しました';
            header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $group->getId());

        // 勉強会登録に失敗した場合
        // } else {
            // セッションにメッセージを保存してエラー画面に遷移
            // $_SESSION['message'] = '勉強会の作成に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
            // header('Location: ' . BASE_DOMAIN . '/error.php');
        // }

    // 勉強会編集画面の場合
    } else {
        // TODO: [コントローラー]
        // 勉強会修正試行
        // 勉強会修正に成功した場合
        // if ($group->updateGroup()) {

        // TODO: [モデル]
        // updateGroup():bool
        // あらかじめプロパティに設定された勉強会情報で、Groupsレコードを修正してください
        // 実行結果の成否を返却してください

            // セッションにメッセージを保存して勉強会詳細画面に遷移
            $_SESSION['message'] = '勉強会を編集しました';
            header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);

        // 勉強会修正に失敗した場合
        // } else {
            // セッションにメッセージを保存してエラー画面に遷移
            // $_SESSION['message'] = '勉強会の編集に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
            // header('Location: ' . BASE_DOMAIN . '/error.php');
        // }
    
    }
}
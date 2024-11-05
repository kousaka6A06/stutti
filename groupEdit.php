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

// 未ログインの場合
if (!isset($_SESSION['userInfo'])) {
    // エラーメッセージと共にログイン画面に遷移
    $errorMessage = 'ログインしてください';
    header('Location: ' . BASE_DOMAIN . '/login.php');
    exit;
}

// ヘッダーの勉強会作成ボタンが押下された場合
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['gid'])) {
    // 勉強会作成画面を描画
    Utils::loadView('勉強会作成', 'view/v_groupEdit.php');

// 勉強会詳細画面の編集ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['gid'])) {
    // TODO: [コントローラー]
    // 勉強会の作成者以外が直接アクセスしてきた場合
    // if (!$user->isOwnerOfGroup($_GET['gid'])) {
        // 勉強会詳細画面に遷移
        // header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $_GET['gid']);

    // 勉強会の作成者の場合
    // } else {
        // 勉強会インスタンスを作成して画面から渡された情報をセット
        $group = new Group();
        $group->setId($_GET['gid']);

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
    $group->setName($_POST['name']);
    $group->setDate($_POST['date']);
    $group->setTime($_POST['time']);
    $group->setLocation($_POST['location']);
    $group->setNumPeople($_POST['num-people']);
    $group->setContent($_POST['content']);
    $group->setTuttiId($_POST['tutti-id']);
    $group->setCreatedById($_SESSION['userId']);

    // 勉強会作成画面の場合
    if (!isset($_GET['gid'])) {
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

            // 勉強会詳細画面に遷移
            header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $group->getId());

        // 勉強会登録に失敗した場合
        // } else {
            // エラーメッセージと共にエラー画面を描画
            // $errorMessage = '勉強会の登録に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
            // Utils::loadView('エラー', 'view/v_error.php');
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

            // 勉強会詳細画面に遷移
            header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $_GET['gid']);

        // 勉強会修正に失敗した場合
        // } else {
            // エラーメッセージと共にエラー画面を描画
            // $errorMessage = '勉強会の修正に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
            // Utils::loadView('エラー', 'view/v_error.php');
        // }
    
    }
}
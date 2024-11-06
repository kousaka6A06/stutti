<?php

require_once 'config/constants.php';
require_once 'model/Group.php';
require_once 'model/MTutti.php';
require_once 'model/User.php';
require_once 'utils/Utils.php';

// セッションが存在しない場合
if (session_status() === PHP_SESSION_NONE) {
    // セッションを開始する
    session_start();
}

// セッションから渡された情報を変数に格納
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

// 画面表示制御用にステータス設定
$userStatus = null;

// ログイン済みの場合
if ($userId) {
    $userStatus = LOGGED_IN;
  
// 未ログインの場合
} else {
    $userStatus = NOT_LOGGED_IN;
}

// TODO: [コントローラー]
// 最近作成された勉強会情報を5件取得
$group = new Group();
// $groups = $group->getNewGroups();

// TODO: [モデル]
// getNewGroups():Group[]
// 最近作成された勉強会情報を5件返却してください

// TODO: [コントローラー]
// tutti情報取得
$tutti = new MTutti();
// $tuttis = $tutti->getAllTutti();

// TODO: [モデル]
// getAllTutti():MTutti[]
// tuttiをidの昇順で全件返却してください

// トップ画面を描画
Utils::loadView('トップ', 'view/v_index.php');
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

// 最近作成された勉強会情報を8件取得
$group = new Group();
$groupInfos = $group->getNewGroups();

// tutti情報取得
$tutti = new MTutti();
$tuttiInfos = $tutti->getAllTutti();

// トップ画面を描画
Utils::loadView('トップ', 'view/v_index.php');
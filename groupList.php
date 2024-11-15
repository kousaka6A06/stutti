<?php

require_once 'model/Group.php';
require_once 'utils/Utils.php';

// 最近作成された勉強会情報をtuttiごとに5件取得
$group = new Group();
$tuttiGroupInfos = $group->getAllTuttiGroups();

// 勉強会一覧画面を描画
Utils::loadView('勉強会一覧', 'view/v_groupList.php');
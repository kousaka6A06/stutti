<?php

require_once 'model/Group.php';
require_once 'utils/Utils.php';

// TODO: [コントローラー]
// 最近作成された勉強会情報をtuttiごとに5件取得
$group = new Group();
// $tuttiGroups = $group->getAllTuttiGroups();

// TODO: [モデル]
// getAllTuttiGroups():array<int, Group[]>
// 最近作成された勉強会情報をtuttiごとに5件返却してください
// tuttiIDをキーにして、Groupの配列を値にもたせてください

// 勉強会一覧画面を描画
Utils::loadView('勉強会一覧', 'view/v_groupList.php');
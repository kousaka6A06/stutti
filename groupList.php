<?php

require_once 'model/Group.php';
require_once 'utils/Utils.php';

// TODO: [コントローラー]
// 最近作成された勉強会情報をtuttiごとに5件取得
$group = new Group();
// $tuttiGroups = $group->getAllTuttiGroups();

// TODO: [モデル]
// getAllTuttiGroups():
// 最近作成された勉強会情報をtuttiごとに5件返却してください
// 下記のイメージ
// 0 => [	
// 		id => 1,
// 		name => 'AWS',
// 		groups => [
// 			[id => 10, name => '勉強会名勉強会名勉強会名',...],
// 			[id => 20, name => '勉強会名勉強会名勉強会名',...],
// 			[id => 30, name => '勉強会名勉強会名勉強会名',...],
// 			[id => 40, name => '勉強会名勉強会名勉強会名',...],
// 			[id => 50, name => '勉強会名勉強会名勉強会名',...]
// 		]
// 	],
// 1 => [	
// 		id => 2,
// 		name => PHP,
// 		groups => [
// 			[...],[...],[...],[...],[...]
// 		]
// 	],
// ...

// 勉強会一覧画面を描画
Utils::loadView('勉強会一覧', 'view/v_groupList.php');
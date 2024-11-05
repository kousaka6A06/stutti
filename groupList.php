<?php
require_once 'config/constants.php';
require_once 'model/Group.php';
require_once 'utils/Utils.php';

// TODO: [コントローラー]
// tuttiごとに最新5件の勉強会情報取得
// $group = new Group();
// $tuttiGroups = $group->getAllTuttiGroups();

// TODO: [モデル]
// getAllTuttiGroups():array<int, Group[]>
// tuttiごとに最新5件の勉強会情報を返却してください
// tuttiIdをキーにして、Groupの配列を値にもたせてください

// 勉強会一覧画面を描画
Utils::loadView('勉強会一覧', 'view/v_groupList.php');
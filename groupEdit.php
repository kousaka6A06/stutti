<?php

require_once 'config/constants.php';
require_once 'model/Belonging.php';
require_once 'model/Group.php';
require_once 'model/MTutti.php';
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
$startTime = isset($_POST['start-time']) ? Utils::e($_POST['start-time']) : null;
$endTime = isset($_POST['end-time']) ? Utils::e($_POST['end-time']) : null;
$location = isset($_POST['location']) ? Utils::e($_POST['location']) : null;
$numPeople = isset($_POST['num-people']) ? Utils::e($_POST['num-people']) : null;
$content = isset($_POST['content']) ? Utils::e($_POST['content']) : null;
$tuttiId = isset($_POST['tutti-id']) ? Utils::e($_POST['tutti-id']) : null;

// 未ログインの場合
if (!$userId) {
    // セッションにメッセージを保存してログイン画面に遷移
    $_SESSION['message'] = '勉強会を編集したい場合はログインしてください';
    header('Location: ' . BASE_DOMAIN . '/login.php');
    exit;
}

// tuttiインスタンスを作成
$tutti = new MTutti();

// 全tutti情報を取得
$tuttiInfos = $tutti->getAllTutti();

// ヘッダーの勉強会作成ボタンが押下された場合
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !$groupId) {
    // 勉強会作成画面を描画
    Utils::loadView('勉強会作成', 'view/v_groupEdit.php');

// 勉強会詳細画面の編集ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $groupId) {
    // ユーザーインスタンスを作成してセッション情報をセット
    $user = new User();
    $user->setId($userId);

    // 勉強会の作成者以外が直接アクセスしてきた場合
    if (!$user->isOwnerOfGroup($groupId)) {
        // セッションにメッセージを保存して勉強会詳細画面に遷移
        $_SESSION['message'] = '作成者以外は勉強会を編集できません';
        header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);

    // 勉強会の作成者の場合
    } else {
        // 勉強会インスタンスを作成して画面から渡された情報をセット
        $group = new Group();
        $group->setId($groupId);

        // 勉強会情報取得
        $groupInfo = $group->getGroupById();

        // 勉強会編集画面を描画
        Utils::loadView('勉強会編集', 'view/v_groupEdit.php');
    }

// 勉強会作成・編集画面の登録ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 勉強会インスタンスを作成して画面から渡された情報をセット
    $group = new Group();
    $group->setName($name);
    $group->setDate($date);
    $group->setStartTime($startTime);
    $group->setEndTime($endTime);
    $group->setLocation($location);
    $group->setNumPeople($numPeople);
    $group->setContent($content);
    $group->setTuttiId($tuttiId);
    $group->setCreatedById($userId);

    // 勉強会作成画面の場合
    if (!$groupId) {
        // バリデーション
        if (!$group->isMatchDate() || !$group->isMatchStartEndTime()) {
            // 画面から渡された情報を次画面に引き継ぎ
            $groupInfo['name'] = $name;
            $groupInfo['date'] = $date;
            $groupInfo['start_time'] = $startTime;
            $groupInfo['end_time'] = $endTime;
            $groupInfo['location'] = $location;
            $groupInfo['num_people'] = $numPeople;
            $groupInfo['content'] = $content;
            $groupInfo['tutti_id'] = $tuttiId;

            // セッションにメッセージを保存して勉強会作成画面を再描画
            $_SESSION['message'] = "";
            if (!$group->isMatchDate()) {
                $_SESSION['message'] .= '開催日に過去の日付が入力されています<br>';
            }
            if (!$group->isMatchStartEndTime()) {
                $_SESSION['message'] .= '終了時刻は開始時刻より後にしてください<br>';
            }
            Utils::loadView('勉強会作成', 'view/v_groupEdit.php');
            exit;
        }

        // 勉強会登録試行
        // 勉強会登録に成功した場合
        if ($group->createGroup()) {
            // 勉強会参加者インスタンスを作成して画面から渡された情報をセット
            $belonging = new Belonging();
            $belonging->setGroupId($group->getId());
            $belonging->setMemberId($userId);

            // メンバー登録試行
            // メンバー登録に成功した場合
            if ($belonging->addMember()) {
                // セッションにメッセージを保存して勉強会詳細画面に遷移
                $_SESSION['message'] = '勉強会を作成しました';
                header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $group->getId());

            // メンバー登録に失敗した場合
            } else {
                // セッションにメッセージを保存してエラー画面に遷移
                $_SESSION['message'] = '勉強会を作成しましたが、参加登録に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
                header('Location: ' . BASE_DOMAIN . '/error.php');
            }

        // 勉強会登録に失敗した場合
        } else {
            // セッションにメッセージを保存してエラー画面に遷移
            $_SESSION['message'] = '勉強会の作成に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
            header('Location: ' . BASE_DOMAIN . '/error.php');
        }

    // 勉強会編集画面の場合
    } else {
        // セッション情報をセット
        $group->setId($groupId);

        // バリデーション
        if (!$group->isMatchDate() || !$group->isMatchStartEndTime() || !$group->isMatchNumPeople()) {
            // セッションにメッセージを保存して勉強会編集画面に再遷移
            $_SESSION['message'] = "";
            if (!$group->isMatchDate()) {
                $_SESSION['message'] .= '開催日に過去の日付が入力されています<br>';
            }
            if (!$group->isMatchStartEndTime()) {
                $_SESSION['message'] .= '終了時刻は開始時刻より後にしてください<br>';
            }
            if (!$group->isMatchNumPeople()) {
                $_SESSION['message'] .= '参加人数は現在参加中の人数より大きくしてください<br>';
            }
            header('Location: ' . BASE_DOMAIN . '/groupEdit.php?gid=' . $groupId);
            exit;
        }

        // 勉強会修正試行
        // 勉強会修正に成功した場合
        if ($group->updateGroup()) {
            // セッションにメッセージを保存して勉強会詳細画面に遷移
            $_SESSION['message'] = '勉強会を編集しました';
            header('Location: ' . BASE_DOMAIN . '/groupDetail.php?gid=' . $groupId);

        // 勉強会修正に失敗した場合
        } else {
            // セッションにメッセージを保存してエラー画面に遷移
            $_SESSION['message'] = '勉強会の編集に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
            header('Location: ' . BASE_DOMAIN . '/error.php');
        }
    }
}
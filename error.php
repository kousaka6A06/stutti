<?php

require_once 'utils/Utils.php';

// セッションが存在しない場合
if (session_status() === PHP_SESSION_NONE) {
    // セッションを開始する
    session_start();
}

// セッションから渡された情報を変数に格納
$errorMessage = isset($_SESSION['message']) ? $_SESSION['message'] : null;;

// エラー画面を描画
Utils::loadView('エラー', 'view/v_error.php');
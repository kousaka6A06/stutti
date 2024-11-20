<?php

require_once 'config/constants.php';
require_once 'model/User.php';
require_once 'utils/Utils.php';

// セッションが存在しない場合
if (session_status() === PHP_SESSION_NONE) {
    // セッションを開始する
    session_start();
}

// セッション・画面から渡された情報をサニタイズして変数に格納
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$stuttiId = isset($_POST['stutti-id']) ? Utils::e($_POST['stutti-id']) : null;
$password = isset($_POST['password']) ? Utils::e($_POST['password']) : null;
$name = isset($_POST['name']) ? Utils::e($_POST['name']) : null;
$mailAddress = isset($_POST['mail-address']) ? Utils::e($_POST['mail-address']) : null;
$avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : null;

// ログイン済みの場合
if ($userId) {
    // セッションにメッセージを保存してマイページ画面に遷移
    $_SESSION['message'] = 'すでにログインしています';
    header('Location: ' . BASE_DOMAIN . '/myPage.php');
    exit;
}

// ヘッダーのユーザー登録ボタンが押下された場合
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ユーザー登録画面を描画
    Utils::loadView('ユーザー登録', 'view/v_userRegister.php');

// ユーザー登録画面のユーザー登録ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ユーザーインスタンスを作成して画面から渡された情報をセット
    $user = new User();
    $user->setStuttiId($stuttiId);
    $user->setPassword($password);
    $user->setName($name);
    $user->setMailAddress($mailAddress);

    // アバター画像が画面から渡されなかった場合
    if ($avatar['error'] === UPLOAD_ERR_NO_FILE) {
        $user->setAvatar(DEFAULT_AVATAR);

    // アバター画像が画面から渡された場合
    } else {
        // 画像アップロード試行
        $code = $user->uploadAvatar($avatar);

        // 画像アップロードに成功した場合
        if ($code === UPLOAD_OK) {
            // 処理なし(モデル側で画像セット済み)

        // 画像アップロードに失敗した場合
        } else {
            // エラーコードによってメッセージ内容を設定
            $messages = [
                ERR_CODE_INI_SIZE => 'アップロード画像の最大サイズ制限を超えています(PHP)',
                ERR_CODE_FORM_SIZE => 'アップロード画像の最大サイズ制限を超えています(HTML)',
                ERR_CODE_PARTIAL => 'ファイルが一部しかアップロードされていません。<br>繰り返し失敗する場合は管理者に連絡して下さい。',
                ERR_CODE_NO_TMP_DIR => '一時保存フォルダが存在しないためアップロード処理を中止しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。',
                ERR_CODE_CANT_WRITE => 'ディスクへの書き込みに失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。',
                ERR_CODE_MODULE => '拡張モジュールによってアップロードが中断されました。<br>繰り返し失敗する場合は管理者に連絡して下さい。',
                ERR_CODE_EXTENSION => '画像以外のファイルはアップロードできません',
                ERR_CODE_MIME_TYPE => 'ファイルの内容が画像ではありません',
                ERR_CODE_FAIL_UPLOAD => 'アップロード処理に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。'
            ];

            // セッションにメッセージを保存してユーザー登録画面を再描画
            $_SESSION['message'] = $messages[$code];
            Utils::loadView('ユーザー登録', 'view/v_userRegister.php');
            exit;
        }
    }

    // ユーザー登録試行
    // ユーザー登録に成功した場合
    if ($user->createUser()) {
        // セッションにユーザーID・メッセージを保存してマイページ画面に遷移
        $_SESSION['userId'] = $user->getId();
        $_SESSION['message'] = 'ユーザーを作成しました';
        header('Location: ' . BASE_DOMAIN . '/myPage.php');

    // ユーザー登録に失敗した場合
    } else {
        // セッションにメッセージを保存してエラー画面に遷移
        $_SESSION['message'] = 'ユーザーの作成に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
        header('Location: ' . BASE_DOMAIN . '/error.php');
    }
}
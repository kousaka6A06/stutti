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
$password = isset($_POST['password']) ? Utils::e($_POST['password']) : null;
$name = isset($_POST['name']) ? Utils::e($_POST['name']) : null;
$mailAddress = isset($_POST['mail-address']) ? Utils::e($_POST['mail-address']) : null;
$avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : null;

// 未ログインの場合
if (!$userId) {
    // セッションにメッセージを保存してログイン画面に遷移
    $_SESSION['message'] = 'ユーザーを編集したい場合はログインしてください';
    header('Location: ' . BASE_DOMAIN . '/login.php');
    exit;
}

// マイページ画面の編集ボタンが押下された場合
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ユーザーインスタンスを作成してセッション情報をセット
    $user = new User();
    $user->setId($userId);

    // ユーザー情報を取得する
    $userInfo = $user->getUserById();

    // ユーザー編集画面を描画
    Utils::loadView('ユーザー編集', 'view/v_userEdit.php');

// ユーザー編集画面の修正ボタンが押下された場合
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ユーザーインスタンスを作成して画面から渡された情報をセット
    $user = new User();
    $user->setId($userId);
    $user->setPassword($password);
    $user->setName($name);
    $user->setMailAddress($mailAddress);

    // 登録済みのユーザー情報を取得する
    $userInfo = $user->getUserById();

    // アバター画像が画面から渡されなかった場合
    if ($avatar['error'] === UPLOAD_ERR_NO_FILE) {
        // 登録済みの情報のまま
        $user->setAvatar($userInfo['avatar']);

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

            // セッションにメッセージを保存してユーザー編集画面を再描画
            $_SESSION['message'] = $messages[$code];
            Utils::loadView('ユーザー編集', 'view/v_userEdit.php');
            exit;
        }
    }

    // ユーザー編集試行
    // ユーザー編集に成功した場合
    if ($user->updateUser()) {
        // セッションにメッセージを保存してマイページ画面に遷移
        $_SESSION['message'] = 'ユーザーを編集しました';
        header('Location: ' . BASE_DOMAIN . '/myPage.php');

    // ユーザー編集に失敗した場合
    } else {
        // セッションにメッセージを保存してエラー画面に遷移
        $_SESSION['message'] = 'ユーザーの編集に失敗しました。<br>繰り返し失敗する場合は管理者に連絡して下さい。';
        header('Location: ' . BASE_DOMAIN . '/error.php');
    }
}
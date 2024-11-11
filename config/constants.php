<?php

// ドメイン名
define('BASE_DOMAIN', 'http://localhost/stutti');
// define('BASE_DOMAIN', 'https://stutti.net');

// データベースの設定
define('DB_HOST', 'localhost');
define('DB_NAME', 'stutti');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');

// アバター画像
define('DIR_AVATAR', 'img/avatar/');
define('DEFAULT_AVATAR', 'default_avatar.png');
define('UPLOAD_OK', 0);
define('ERR_CODE_INI_SIZE', 1);
define('ERR_CODE_FORM_SIZE', 2);
define('ERR_CODE_PARTIAL', 3);
define('ERR_CODE_NO_TMP_DIR', 6);
define('ERR_CODE_CANT_WRITE', 7);
define('ERR_CODE_MODULE', 8);
define('ERR_CODE_EXTENSION', 10);
define('ERR_CODE_MIME_TYPE', 11);
define('ERR_CODE_FAIL_UPLOAD', 12);

// ユーザーステータス
define('NOT_LOGGED_IN', '0');
define('LOGGED_IN', '1');
define('GROUP_MEMBER', '2');
define('GROUP_OWNER', '3');

// 勉強会ステータス
define('NOT_FULL', '0');
define('FULL', '1');
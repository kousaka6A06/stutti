<?php

require_once 'config/constants.php';
require_once 'utils/Utils.php';

// if (!isset($_SESSION['user_id'])) {
//     header('Location: ' . BASE_DOMAIN . '/index.php');
//     exit;
// }

Utils::loadView('マイページ', 'view/v_myPage.php');

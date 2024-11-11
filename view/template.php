<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $v_title ?>STUTTI - 勉強会グループ募集</title>
    <!-- BootstrapのCSSをリンク -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- 外部CSSファイルをリンク -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- ヘッダー -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand header-logo" href="index.php">
                    STUTTI
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto"> <!-- ml-auto → ms-auto -->
                        <?php if (isset($_SESSION['userId'])): ?>
                            <li class="nav-item">
                                <a class="btn btn-outline-light mx-2" href="groupEdit.php">勉強会を作る</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-light mx-2" href="mypage.php">マイページ</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-light mx-2" href="logout.php">ログアウト</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="btn btn-outline-light mx-2" href="login.php">ログイン</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-light mx-2" href="userRegister.php">ユーザー登録</a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- メイン -->
    <main class="flex-grow-1">
        <?php // TODO ?>
        <?php if (isset($_SESSION['message'])): ?>
            <p>↓デバッグ用あとでけす↓</p>
            <p>$_SESSION['message']：<?= $_SESSION['message'] ?></p>
            <?php unset($_SESSION['message']) ?>
        <?php endif ?>
        <?php include $v_includeFile; ?>
    </main>

    <!-- フッター -->
    <footer class="bg-dark-subtle text-white text-center py-3 mt-auto">
        <p>&copy; 2024 STUTTI</p>
    </footer>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome for social icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- javascript -->
    <script src="../javascript/script.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $v_title ?> / STUTTI - 勉強会グループ募集</title>
    <!-- BootstrapのCSSをリンク -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rampart+One&family=Yusei+Magic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- 外部CSSファイルをリンク -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/favicon.ico">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- 背景アニメーション用のキャンバス -->
    <canvas id="canvas"></canvas>
    <!-- ヘッダー -->
    <header class="header rounded-header fixed-header">
        <nav class="navbar navbar-expand-md">
            <div class="container-md">
                <h1>
                    <a class="navbar-brand" href="index.php">
                        STUTTI
                    </a>
                </h1>
                <!-- ハンバーガーメニューのボタン -->
                <button class="navbar-toggler collapsed shadow-none focus-shadow-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon custom-toggler-icon"></span>
                </button>
                <!-- メニュー -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item py-1">
                            <a class="btn mx-2 h-btm text-light" href="groupList.php">勉強会一覧</a>
                        </li>
                        <?php if (isset($_SESSION['userId'])): ?>
                            <li class="nav-item py-1">
                                <a class="btn mx-2 h-btm text-light" href="groupEdit.php">勉強会を作る</a>
                            </li>
                            <li class="nav-item py-1">
                                <a class="btn mx-2 h-btm text-light" href="myPage.php">マイページ</a>
                            </li>
                            <li class="nav-item py-1">
                                <a class="btn mx-2 h-btm text-light" href="logout.php">ログアウト</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item py-1">
                                <a class="btn mx-2 h-btm text-light" href="login.php">ログイン</a>
                            </li>
                            <li class="nav-item py-1">
                                <a class="btn mx-2 h-btm text-light" href="userRegister.php">ユーザー登録</a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- メイン -->
    <main class="container-xl flex-grow-1">
        <?php if (isset($_SESSION['message'])): ?>
            <p class="error-message text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 p-4 w-50 mx-auto text-center">
                <!-- style="max-width: 700px; margin-top: 100px;"> -->
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
        <?php endif ?>
        <?php include $v_includeFile; ?>
    </main>

    <!-- フッター -->
    <footer class="text-white mt-5">
        <div class="container-fluid p-0">
            <img src="img/footer.png" class="img-fluid w-100" alt="Footer Image">
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- javascript -->
    <script src="javascript/script.js"></script>
</body>

</html>
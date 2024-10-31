<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $v_title ?>Stutti - 勉強会グループ募集</title>
    <!-- BootstrapのCSSをリンク -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">



    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- 外部CSSファイルをリンク -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        .logo {
            max-width: 250px;
            /* 画像の最大幅 */
            /* margin: 0 0 0 255; */
            position: relative;
            /* 位置調整が可能 */
            top: 15px;
            /* 上下の位置を調整 */
        }
    </style>

</head>

<body>
    <!-- ヘッダー -->
    <header class="header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand header-logo" href="index.php">
                Stutti
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- ml-auto → ms-auto -->
                    <li class="nav-item">
                        <a class="btn btn-outline-info mx-2" href="groupEdit.php">勉強会を作る</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-info mx-2" href="mypage.php">マイページ</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-info mx-2" href="mypage.php">ログアウト</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light mx-2" href="login.php">ログイン</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light mx-2" href="userRegister.php">会員登録</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

    <!-- メイン -->
    <?php include $v_includeFile; ?>

    <p id="page-top"><a href="index.php">TOP</a></p>
    <!-- <p id="page-top"><a href="index.php">上に戻る</a></p> -->

    <!-- フッター -->
    <footer class="bg-dark-subtle text-white text-center py-3 mt-1">
        <p>&copy; 2024 Stutti</p>
    </footer>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome for social icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- javascript -->
    <script src="script.js"></script>

</body>

</html>
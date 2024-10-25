<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $v_title ?>Stutti - 勉強会グループ募集</title>
    <!-- BootstrapのCSSをリンク -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- 外部CSSファイルをリンク -->
    <link rel="stylesheet" href="style/style.css">

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
    <main>
        <!-- ヘッダー -->
        <header class="bg-info header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand header-logo" href="index.php">
                    Stutti    
                    <!-- <img src="img/logo.png" alt=""> -->
                    </a>
                    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="btn btn-outline-warning mx-2" href="groupEdit.php">勉強会を作る</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-warning mx-2" href="mypage.php">マイページ</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-warning mx-2" href="mypage.php">ログアウト</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-light mx-2" href="login.php">ログイン</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-light mx-2" href="memberRegister.php">会員登録</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- メイン -->
        <?php include $v_includeFile; ?>

        <!-- フッター -->
        <footer class="bg-success text-white text-center py-3 mt-1">
            <p>&copy; 2024 Stutti</p>
        </footer>
    </main>


    <!-- BootstrapとjQueryのスクリプト -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- FontAwesome for social icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
<?php
$images = [
    "footer1.png",
    "footer3.png",
    "footer2.png",
    "footer4.png",
    "footer5.png",
    "footer7.png"
];
?>


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
    <header class="header rounded-header">
        <nav class="navbar navbar-expand-sm">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    STUTTI
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <?php if (isset($_SESSION['userId'])): ?>
                            <li class="nav-item">
                                <a class="btn mx-2 h-btm" href="groupEdit.php">勉強会を作る</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn mx-2 h-btm" href="mypage.php">マイページ</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn mx-2 h-btm" href="logout.php">ログアウト</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="btn mx-2 h-btm" href="login.php">ログイン</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn mx-2 h-btm" href="userRegister.php">ユーザー登録</a>
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
    <footer class="bg-light py-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php
                // 配列を2回繰り返して12個の画像を表示
                for ($i = 0; $i < 2; $i++):
                    foreach ($images as $image): ?>
                        <div class="col-1 p-2">
                            <img src="img/<?= $image ?>" alt="<?= $image ?>" class="img-fluid w-50">
                        </div>
                    <?php endforeach;
                endfor; ?>
            </div>
            <!-- pタグを中央に配置 -->
            <div class="row">
                <div class="col-12 d-flex justify-content-evenly">
                    <p class="mb-0">&copy; 2024 STUTTI</p>
                    <p class="mb-0">プライバシーポリシー</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome for social icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- javascript -->
    <script src="javascript/script.js"></script>
</body>

</html>
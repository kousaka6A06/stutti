<?php
$images = [
    "footer1.png",
    "footer3.png",
    "footer2.png",
    "footer4.png",
    "footer5.png",
    "footer7.png"
];

$cards = [
    ['id' => '1', 'title' => 'AWS', 'color' => '#FF9800'],
    ['id' => '2', 'title' => 'Linux', 'color' => '#49BDF0'],
    ['id' => '3', 'title' => 'PHP', 'color' => '#4F5B93'],
    ['id' => '4', 'title' => 'Java', 'color' => '#7B5544'],
    ['id' => '5', 'title' => 'Python', 'color' => '#FFC20E'],
    ['id' => '6', 'title' => 'フロントエンド', 'color' => '#4FC94F'],
    ['id' => '7', 'title' => 'データベース', 'color' => '#444655'],
    ['id' => '8', 'title' => '応用数学', 'color' => '#225CC7'],
    ['id' => '9', 'title' => 'ビジネス英語', 'color' => '#BA252F'],
    ['id' => '10', 'title' => '技術全般', 'color' => '#BABABA'],
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
    <!-- FontAwesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- 外部CSSファイルをリンク -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- 背景アニメーション用のキャンバス -->
    <canvas id="canvas"></canvas>
    
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
                                <a class="btn mx-2 h-btm text-light" href="groupEdit.php">勉強会を作る</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn mx-2 h-btm text-light" href="myPage.php">マイページ</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn mx-2 h-btm text-light" href="logout.php">ログアウト</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="btn mx-2 h-btm text-light" href="login.php">ログイン</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn mx-2 h-btm text-light" href="userRegister.php">ユーザー登録</a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- メイン -->
    <main class="flex-grow-1">
        <?php if(isset($_SESSION['message'])): ?>
            <p class="text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 p-4 container" style="max-width: 700px">
                <?= $_SESSION['message'] ?>
            </p>
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
    <!-- javascript -->
    <script src="javascript/script.js"></script>
</body>

</html>
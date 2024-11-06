<?php
$cards = [
    ['title' => 'AWS', 'color' => '#FF9800'],
    ['title' => 'Linux', 'color' => '#4FC94F'],
    ['title' => 'PHP', 'color' => '#4F5573'],
    ['title' => 'Java', 'color' => '#7B5544'],
    ['title' => 'Python', 'color' => '#49BDF0'],
    ['title' => 'フロントエンド', 'color' => '#FFC20E'],
    ['title' => 'データベース', 'color' => '#444655'],
    ['title' => '応用数学', 'color' => '#225CC7'],
    ['title' => 'ビジネス英語', 'color' => '#BA252F'],
    ['title' => '技術全般', 'color' => '#BABABA'],
];
?>

<div class="container mt-5">
    <div class="position-relative">
        <img src="img/board.png" alt="" class="img-fluid">
        <p class="text-overlay">
            Stuttiとは<br>
            studti – 未来の可能性を広げる学びの場。<br>
            学びの仲間とつながる、stuttiで成長の一歩を。
        </p>
    </div>
</div>
<br>
<hr>
<!-- 募集中勉強会 -->
<div class="container-md mt-5">
    <section>
        <h2>募集中の勉強会</h2>
        <div class="row">
            <?php for ($i = 0; $i < 8; $i++) { ?>
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-title">
                                <div>
                                    <h3>AWS</h3>
                                </div>
                            </li>
                        </ul>
                        <div class="card-body">
                            <h3 class="card-title">「勉強会タイトル」</h3>
                            <p class="card-text">「勉強内容」例：AWSを活用したインフラ設計や運用のコツを共有し、最新の技術動向について議論しましょう。</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">「日時」</li>
                            <li class="list-group-item">「参加人数」</li>
                            <li class="list-group-item d-flex justify-content-end">
                                <a href="groupDetail.php" class="btn btn-secondary btn-sm">詳しく見る</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="text-center mt-3">
            <a href="groupList.php" class="btn view-more-btn"><span>勉強会一覧を表示</span></a>
        </div>
    </section>
</div>
<br><br>
<hr>
<!-- tutti広場 -->
<div class="container-md mt-5">
    <h2>Tutti</h2>
    <div class="row g-3">
        <?php foreach ($cards as $card): ?>
            <div class="col">
                <a href="tutti.php" style="text-decoration: none;">
                    <div class="card tutti-card"
                        style="height: 250px; background-color: <?= $card['color']; ?>; color: #586365;">
                        <div class="card-body p-0 d-flex flex-column align-items-center">
                            <div class="husen">
                                <h3 class="card-title vertical-text"><?= $card['title']; ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
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

// 10個のカードのインデックス
$totalCards = 10;
// 4個にtilt-cardを適用するためのインデックスをランダムに取得
$tiltedIndexes = array_rand(range(0, $totalCards - 1), 4);

?>

<section>
    <?php foreach ($cards as $index => $card): ?>
        <div class="d-flex justify-content-center">
            <div class="container group-section row mt-3 d-flex justify-content-center align-items-end">
                <div class="col-md-1">
                    <div class="card tutti-card2 <?= in_array($index, $tiltedIndexes) ? 'tilt-card' : ''; ?>"
                        style="border: 10px solid <?= $card['color']; ?>; color: #586365">
                        <div class="card-body d-flex flex-column align-items-center" style="height: 150px;">
                            <h5 class="card-title vertical-text"><?= $card['title']; ?></h5>
                        </div>
                    </div>
                </div>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body" style="height: 100px;">
                                <h5 class="card-title">「勉強会タイトル」</h5>
                                <p class="card-text">「勉強内容」</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">「日時」</li>
                                <li class="list-group-item">「参加人数」</li>
                                <li class="list-group-item d-flex justify-content-end">
                                    <a href="groupDetail.php?gid=<?= $i+1 ?>" class="btn btn-secondary btn-sm">詳しく見る</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <?php endforeach; ?>
</section>
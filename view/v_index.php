<?php $cards = [
    ['id' => '1', 'title' => 'AWS', 'color' => '#FF9800'],
    ['id' => '2', 'title' => 'Linux', 'color' => '#4FC94F'],
    ['id' => '3', 'title' => 'PHP', 'color' => '#4F5B93'],
    ['id' => '4', 'title' => 'Java', 'color' => '#7B5544'],
    ['id' => '5', 'title' => 'Python', 'color' => '#49BDF0'],
    ['id' => '6', 'title' => 'フロントエンド', 'color' => '#FFC20E'],
    ['id' => '7', 'title' => 'データベース', 'color' => '#444655'],
    ['id' => '8', 'title' => '応用数学', 'color' => '#225CC7'],
    ['id' => '9', 'title' => 'ビジネス英語', 'color' => '#BA252F'],
    ['id' => '10', 'title' => '技術全般', 'color' => '#BABABA'],
];
?>

<div class="container">
    <div class="board_3YD0c">
        <div class="board_inner">
            <section class="board_list">
                <p>
                    STUTTIは、学習に特化したオンラインコミュニティで、<br>
                    社会人や学生が自由に勉強会を作成し、参加者同士が交流できるプラットフォームです。<br><br>
                    ユーザー登録することで、勉強会の作成や参加が可能となり、<br>
                    興味のある分野で活発な意見交換を行うことができます。<br><br>
                    Tuttiと呼ばれるカテゴリには、メンバー登録なしでコメントができるため、<br>
                    知識の共有やスキルアップのためのディスカッションも可能です。<br>
                    学びの場をもっと身近に、そして楽しく提供します。
                </p>
            </section>
        </div>
    </div>
</div>

<!-- 募集中勉強会 -->
<div class="container-md mt-5">
    <section>
        <h2>募集中の勉強会</h2>
        <div class="row">
            <?php foreach ($cards as $card) { ?>
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-title">
                                <div>
                                    <!-- ボタンの色を動的に設定 -->
                                    <button type="button" class="btn btn-sm"
                                        style="background-color: <?= $card['color']; ?>; color: white;">
                                        <?= $card['title']; ?>
                                    </button>
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
                                <a href="groupDetail.php?gid=<?= $card['id']; ?>" class="btn btn-secondary btn-sm">詳しく見る</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="text-center mt-3">
            <a href="groupList.php" class="btn view-more-btn"><span>View more</span></a>
        </div>
    </section>
</div>

<!-- tutti広場 -->
<div class="container-md">
    <h2>TUTTI</h2>
    <div class="row d-flex justify-content-evenly tutti-row">
        <?php foreach ($cards as $card): ?>
            <div class="col-1">
                <a href="tutti.php?tid=<?= $card['id']; ?>" style="text-decoration: none;">
                    <div class="card tutti-card p-0 shadow"
                        style="height: 250px; background-color: <?= $card['color']; ?>; color: #586365; flex-direction: row;">
                        <div class="husen">
                            <h3 class="card-title vertical-text"><?= $card['title']; ?></h3>
                        </div>
                        <div class="lines">
                            <div class="line line-1"></div>
                            <div class="line line-2"></div>
                            <div class="line line-3"></div>
                            <div class="line line-4"></div>
                        </div>

                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
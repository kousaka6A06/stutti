<div class="container">
    <div class="board-3YD0c">
        <!-- マーカー -->
        <div class="marker1"></div>
        <div class="marker2"></div>
        <div class="marker3"></div>
        <!-- マグネット -->
        <div class="magnet1"></div>
        <div class="magnet2"></div>
        <div class="magnet3"></div>
        <div class="board-inner">
            <section class="board-list">
                <div class="feature">
                    <i class="fa-solid fa-users"></i>
                    <p>STUTTIは、学習に特化したオンラインコミュニティで、<br>
                        社会人や学生が自由に勉強会を作成し、参加者同士が交流できるプラットフォームです。</p>
                </div>

                <div class="feature">
                    <i class="fa-solid fa-comment-dots"></i>
                    <p>ユーザー登録することで、勉強会の作成や参加が可能となり、<br>
                        興味のある分野で活発な意見交換を行うことができます。</p>
                </div>

                <div class="feature">
                    <i class="fa-solid fa-comments"></i>
                    <p>Tuttiと呼ばれるカテゴリには、メンバー登録なしでコメントができるため、<br>
                        知識の共有やスキルアップのためのディスカッションも可能です。</p>
                </div>

                <div class="feature">
                    <i class="fa-solid fa-book-open"></i>
                    <p>学びの場をもっと身近に、そして楽しく提供します。</p>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- 募集中勉強会 -->
<div class="container-md mt-5">
    <section>
        <div class="d-flex justify-content-between align-items-center">
            <h2>募集中の勉強会</h2>
            <div class="icon-spacing">
                <i class="fa-brands fa-aws fa-2x"></i>
                <i class="fa-brands fa-linux fa-2x"></i>
                <i class="fa-brands fa-php fa-2x"></i>
                <i class="fa-brands fa-java fa-2x"></i>
                <i class="fa-brands fa-python fa-2x"></i>
                <i class="fa-solid fa-file-code fa-2x"></i>
                <i class="fa-solid fa-database fa-2x"></i>
                <i class="fa-solid fa-calculator fa-2x"></i>
                <i class="fa-brands fa-etsy fa-2x"></i>
                <i class="fa-solid fa-laptop-code fa-2x"></i>
            </div>
        </div>

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
                            <p class="card-text">「勉強内容」例：AWSを活用したインフラ設計について議論しましょう。</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-end">
                                <i class="fa fa-calendar"></i> 「日時」
                            </li>
                            <li class="list-group-item d-flex justify-content-end">
                                <i class="fa fa-users"></i> 「参加人数」
                            </li>
                            <li class="list-group-item d-flex justify-content-end">
                                <a href="groupDetail.php?gid=<?= $card['id']; ?>" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-arrow-right"></i>詳しく見る
                                </a>
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
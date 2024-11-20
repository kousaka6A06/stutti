<!-- 初期テキスト -->
<div class="tutti-intro" id="tuttiIntro">AWSコミュニティ</div>

<!-- コンテンツ全体をラップ -->
<div class="tutti-hidden" id="tuttiContent">
    <!-- 固定された背景テキスト -->
    <div class="tutti-background-text" id="tuttiBackgroundText">NEWS</div>

    <!-- セクションコンテンツ -->
    <div class="tutti-sections">
        <!-- セクション1 -->
        <section class="tutti-section" data-background="NEWS">
            <div class="container-md tutti-news">
                <ul class="list-group">
                    <li class="list-group-item tutti-content-item">勉強会「PHP入門」開催決定！日程は11月25日。</li>
                    <li class="list-group-item tutti-content-item">新しいカテゴリー「React」を追加しました。</li>
                    <li class="list-group-item tutti-content-item">TUTTIが正式リリースされました！</li>
                </ul>
            </div>
        </section>

        <!-- セクション2 -->
        <section class="tutti-section" data-background="Study Group">
            <div class="container-md tutti-groups">
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
        </section>

        <!-- セクション3 -->
        <section class="tutti-section" data-background="Message">
            <div class="container-md tutti-message">
                <p class="lead tutti-content-item">TUTTIは、学びたい全ての人に平等な学習の機会を提供します。</p>
                <p class="tutti-content-item">勉強会を通じて、新しいスキルを習得し、仲間とつながる場を提供することを目指しています。</p>
            </div>
        </section>
    </div>
</div>

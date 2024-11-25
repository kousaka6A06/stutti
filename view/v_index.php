<?php
global $groupInfos, $tuttiInfos;
?>
<section class="white-board mx-auto">
    <h2 class="text-center heading07" data-en="About">なんですかこのサイトは</h2>
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
</section>

<!-- 募集中勉強会 -->
<section class="study-group mx-auto">
    <div class="d-flex custom-flex justify-content-between">
        <h2 class="heading07" data-en="Groups">募集中の勉強会</h2>
        <div class="icon-spacing">
            <?php foreach ($tuttiInfos as $tuttiInfo): ?>
                <i class="<?= $tuttiInfo['icon'] ?> fa-2x" style="color: <?= $tuttiInfo['color'] ?>"></i>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="text-center mt-1 mt-md-3 mt-xl-3">
        <a href="groupList.php" class="btn view-more-btn">
            <span>勉強会一覧</span>
        </a>
    </div>

    <div class="row mt-4">
        <?php foreach ($groupInfos as $groupInfo): ?>
            <div class="col-md-6 col-xl-4 col-xxl-3 mb-3">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item list-title d-flex justify-content-between align-items-baseline ps-0 pt-0">
                            <div>
                                <a href="tutti.php?tid=<?= $groupInfo['tutti_id'] ?>" class="btn btn-sm align-middle"
                                    style="background-color: <?= $groupInfo['tutti_color'] ?>; color: white;">
                                    <i class="<?= $groupInfo['tutti_icon'] ?>" style="color: white;"></i>
                                    <span><?= $groupInfo['tutti_name'] ?></span>
                                </a>
                            </div>
                            <span class="d-flex justify-content-end align-items-baseline">
                                <i class="fa fa-users me-2"></i>
                                <?= $groupInfo['num_people'] ?>人
                            </span>
                        </li>
                    </ul>
                    <div class="card-body pt-1">
                        <h3 class="card-title fw-semibold">
                            <?= $groupInfo['name'] ?>
                        </h3>
                        <p class="card-text"><?= $groupInfo['content'] ?></p>
                        <div class="d-flex justify-content-end">
                            <a href="groupDetail.php?gid=<?= $groupInfo['id'] ?>" class="btn btn-secondary btn-sm">
                                続き<i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="d-flex justify-content-end align-items-baseline text-end">
                                <i class="fa fa-calendar me-2"></i>
                                <?= $groupInfo['date'] ?><br>
                            </span>
                            <span class="d-flex justify-content-end align-items-baseline text-end">
                                <i class="fa-regular fa-clock me-1"></i>
                                <?=
                                empty($groupInfo['start_time']) && empty($groupInfo['end_time'])
                                    ? "時間未定"
                                    : (empty($groupInfo['start_time']) ? "未定" : $groupInfo['start_time'])
                                    . "~"
                                    . (empty($groupInfo['end_time']) ? "未定" : $groupInfo['end_time'])
                                ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-1 mt-md-3 mt-xl-3">
        <a href="groupList.php" class="btn view-more-btn">
            <span>勉強会一覧</span>
        </a>
    </div>
</section>

<!-- tutti -->
<section class="tutti-list mx-auto">
    <h2 class="heading07" data-en="community">
        <div class="tutti-title">
            TUTTIコミュニティ
        </div>
    </h2>
    <div class="row d-flex justify-content-evenly tutti-row">
        <?php foreach ($tuttiInfos as $tuttiInfo): ?>
            <div class="col-4 col-md-1 col-lg-1">
                <a href="tutti.php?tid=<?= $tuttiInfo['id'] ?>" style="text-decoration: none;">
                    <div class="card tutti-card p-0 shadow"
                        style="background-color: <?= $tuttiInfo['color'] ?>;">
                        <div class="husen">
                            <h3 class="card-title vertical-text"><?= $tuttiInfo['name'] ?></h3>
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
</section>
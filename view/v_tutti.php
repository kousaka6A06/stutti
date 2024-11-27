<?php
global $tuttiInfo, $groupInfos, $commentInfos, $newsInfos;
?>

<!-- 初期テキスト -->
<div class="tutti-intro" id="tuttiIntro"><?= $tuttiInfo['name'] ?></div>

<!-- コンテンツ全体をラップ -->
<div class="tutti-hidden" id="tuttiContent">
    <!-- 固定された背景テキスト -->
    <div class="tutti-background-text" id="tuttiBackgroundText"></div>

    <!-- セクションコンテンツ -->
    <div class="tutti-sections">
        <!-- セクション1 -->
        <section class="tutti-section" data-background="News">
            <div class="tutti-news">
                <dl class="list-group">
                    <?php foreach ($newsInfos as $newsInfo): ?>
                        <dt class="list-group-item"><?= explode(' ', $newsInfo['created_at'])[0] ?></dt>
                        <dd class="list-group-item"><a href="<?= $newsInfo['url'] ?>" class="text-dark" target="_blank" rel="noopener noreferrer"><?= $newsInfo['content'] ?></a></dd>
                    <?php endforeach; ?>
                </dl>
            </div>
        </section>

        <!-- セクション2 -->
        <section class="tutti-section" data-background="Groups">
            <div class="tutti-groups">
                <div class="row mt-4">
                    <?php foreach ($groupInfos as $groupInfo): ?>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xxl-3 mb-2">
                            <div class="card shadow">
                                <a href="groupDetail.php?gid=<?= $groupInfo['id'] ?>" class="stretched-link"></a>
                                <div class="card-body">
                                    <h3 class="card-title fw-semibold"><?= $groupInfo['name'] ?></h3>
                                    <p class="card-text txt-limit"><?= $groupInfo['content'] ?></p>
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
                                        <span class="d-flex justify-content-end align-items-baseline">
                                            <i class="fa fa-users me-2"></i>
                                            <?= $groupInfo['participants'] ?> / <?= $groupInfo['num_people'] ?>人
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        </section>

        <!-- セクション3 -->
        <section class="tutti-section" data-background="Message">
            <div class="tutti-message bg-light p-4 rounded shadow list-group">
                <p class="p-3"><?= $tuttiInfo['about'] ?></p>
                <?php if (empty($commentInfos)): ?>
                    <p class="text-center py-3">まだコメントは投稿されていません</p>
                <?php else: ?>
                    <table class="maintable w-100 mb-5">
                        <thead>
                            <tr>
                                <th class="p-3 w-25" style="background-color: <?= $tuttiInfo['color'] ?>;">投稿者</th>
                                <th class="p-3 w-75" style="background-color: <?= $tuttiInfo['color'] ?>;">投稿内容</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commentInfos as $commentInfo): ?>
                                <tr>
                                    <td class="p-3 w-25">
                                        <?= $commentInfo['name'] ?>
                                    </td>
                                    <td class="p-3 w-75">
                                        <?= $commentInfo['content'] ?><br>
                                        <small class="opacity-50"><?= $commentInfo['created_at'] ?></small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <p class="text-center">コメントを投稿する</p>
                <form action="commentPost.php" method="POST" enctype="multipart/form-data" class="text-center">
                    <input type="text" name="name" class="ps-1 w-75" maxlength="30" oninput="removeEmoji(this)" placeholder="投稿者（未入力：名無し）">
                    <textarea type="text" name="content" class="p-1 w-75" maxlength="250" oninput="removeEmoji(this)" placeholder="投稿内容" required></textarea><br>
                    <input type="hidden" name="tid" value="<?= $tuttiInfo['id'] ?>">
                    <button type="submit" class="btn btn-dark w-30">投稿</button>
                </form>
            </div>
        </section>
    </div>
</div>
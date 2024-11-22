<?php
global $tuttiInfo, $groupInfos, $commentInfos, $newsInfos;
?>

<!-- 初期テキスト -->
<div class="tutti-intro" id="tuttiIntro"><?= $tuttiInfo['name'] ?>コミュニティ</div>

<!-- コンテンツ全体をラップ -->
<div class="tutti-hidden" id="tuttiContent">
    <!-- 固定された背景テキスト -->
    <div class="tutti-background-text" id="tuttiBackgroundText">NEWS</div>

    <!-- セクションコンテンツ -->
    <div class="tutti-sections">
        <!-- セクション1 -->
        <section class="tutti-section" data-background="News">
            <div class="">
                <dl class="list-group">
                    <?php foreach ($newsInfos as $newsInfo) : ?>
                        <dt class="list-group-item"><?= explode(' ', $newsInfo['created_at'])[0] ?></dt>
                        <dd class="list-group-item"><a href="<?= $newsInfo['url'] ?>" class="text-dark"><?= $newsInfo['content'] ?></a></dd>
                    <?php endforeach; ?>
                </dl>
            </div>
        </section>

        <!-- セクション2 -->
        <section class="tutti-section" data-background="Study Group">
            <div class="">
                <div class="row">
                    <?php foreach ($groupInfos as $groupInfo) : ?>
                        <div class="col-md-3 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><?= $groupInfo['name'] ?></h3>
                                    <p class="card-text"><?= $groupInfo['content'] ?></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-end">
                                        <i class="fa fa-calendar"></i>
                                        <?= $groupInfo['date'] ?>
                                        <?=
                                            empty($groupInfo['start_time']) && empty($groupInfo['end_time'])
                                                ? "時間未定"
                                                :
                                                    (empty($groupInfo['start_time']) ? "未定" : $groupInfo['start_time'])
                                                    . "~"
                                                    . (empty($groupInfo['end_time']) ? "未定" : $groupInfo['end_time'])
                                        ?>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-end">
                                        <i class="fa fa-users"></i><?= $groupInfo['num_people'] ?>人
                                    </li>
                                    <li class="list-group-item d-flex justify-content-end">
                                        <a href="groupDetail.php?gid=<?= $groupInfo['id'] ?>" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-arrow-right"></i>詳しく見る
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        </section>

        <!-- セクション3 -->
        <section class="tutti-section" data-background="Message">
            <div class="bg-light p-4 rounded shadow">
                <p class="p-3"><?= $tuttiInfo['about'] ?></p>
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
                                <small><?= $commentInfo['created_at'] ?></small>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="text-center">コメントを投稿する</p>
                <form action="commentPost.php" method="POST" enctype="multipart/form-data" class="text-center">
                    <input type="text" name="name" class="ps-1 w-75" placeholder="投稿者（未入力の場合は「名無し」で投稿されます）">
                    <textarea type="text" name="content" class="p-1 w-75" placeholder="投稿内容" required></textarea><br>
                    <input type="hidden" name="tid" value="<?= $tuttiInfo['id'] ?>">
                    <button type="submit" class="btn btn-dark w-30">投稿</button>
                </form>
            </div>
        </section>
    </div>
</div>
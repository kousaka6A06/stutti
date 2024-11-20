<pre>
<?php
global $groupId, $groupInfo, $userStatus, $groupStatus, $messageInfos;
?>
</pre>

<h1 class="text-center">勉強会詳細</h1>
<section class="container-md mb-5">
    <h2 class="my-3">勉強会情報</h2>
    <div class="bg-light p-4 rounded shadow col-10 col-md-8 col-xl-6 mx-auto">
        <table class="maintable w-100 mb-5">
            <tbody>
                <tr>
                    <th class="p-3 w-25">勉強会名</th>
                    <td class="p-3 w-75">
                        <a href="tutti.php?tid=<?= $groupInfo['tutti_id'] ?>" class="btn btn-sm align-middle mx-1"
                            style="background-color: <?= $groupInfo['tutti_color'] ?>; color: white;">
                            <i class="<?= $groupInfo['tutti_icon'] ?>" style="color: white;"></i>
                            <span><?= $groupInfo['tutti_name'] ?></span>
                        </a>
                        <?= $groupInfo['name'] ?>
                    </td>
                </tr>
                <tr>
                    <th class="p-3 w-25">開催日時</th>
                    <td class="p-3 w-75">
                        <?= $groupInfo['date'] ?>
                        <?=
                            empty($groupInfo['start_time']) && empty($groupInfo['end_time'])
                                ? "時間未定"
                                :
                                    (empty($groupInfo['start_time']) ? "未定" : $groupInfo['start_time'])
                                    . "~"
                                    . (empty($groupInfo['end_time']) ? "未定" : $groupInfo['end_time'])
                        ?>
                    </td>
                </tr>
                <tr>
                    <th class="p-3 w-25">開催場所</th>
                    <td class="p-3 w-75"><?= $groupInfo['location'] ?></td>
                </tr>
                <tr>
                    <th class="p-3 w-25">参加人数</th>
                    <td class="p-3 w-75"><?= $groupInfo['num_people'] ?>人</td>
                </tr>
                <tr>
                    <th class="p-3 w-25">作成者名</th>
                    <td class="p-3 w-75"><?= $groupInfo['user_name'] ?></td>
                </tr>
                <tr>
                    <th class="p-3 w-25">勉強内容</th>
                    <td class="p-3 w-75"><?= $groupInfo['content'] ?></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-2">
            <?php if ($userStatus === NOT_LOGGED_IN): ?>
                <?php if ($groupStatus === NOT_FULL): ?>
                    <p class="text-danger">勉強会に参加したい場合はログインしてください</p>
                <?php else: ?>
                    <p class="text-danger">満員のため勉強会に参加できません</p>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($userStatus === LOGGED_IN): ?>
                <?php if ($groupStatus === NOT_FULL): ?>
                    <a href="participate.php?gid=<?= $groupInfo['id'] ?>" class="btn btn-secondary btn-sm">参加</a>
                <?php else: ?>
                    <p class="text-danger">満員のため勉強会に参加できません</p>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($userStatus === GROUP_MEMBER): ?>
                <p class="text-danger">この勉強会に参加中です</p>
            <?php endif; ?>
            <?php if ($userStatus === GROUP_OWNER): ?>
                <a href="groupEdit.php?gid=<?= $groupInfo['id'] ?>" class="btn btn-secondary btn-sm">編集</a>
                <a href="groupDelete.php?gid=<?= $groupInfo['id'] ?>" class="btn btn-secondary btn-sm ms-2">削除</a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php if ($userStatus === GROUP_MEMBER || $userStatus === GROUP_OWNER): ?>
    <section class="container-md mb-5">
        <h2 class="my-3">メッセージ</h2>
        <div class="bg-light p-4 rounded shadow col-10 col-md-8 col-xl-6 mx-auto">
            <table class="maintable w-100 mb-5">
                <thead>
                    <tr>
                        <th class="p-3 w-25" style="background-color: <?= $groupInfo['tutti_color'] ?>;">投稿者</th>
                        <th class="p-3 w-75" style="background-color: <?= $groupInfo['tutti_color'] ?>;">投稿内容</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messageInfos as $messageInfo): ?>
                    <tr>
                        <td class="p-3 w-25">
                            <?= $messageInfo['member_name'] ?>
                        </td>
                        <td class="p-3 w-75">
                            <?= $messageInfo['content'] ?><br>
                            <small><?= $messageInfo['created_at'] ?></small>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="text-center">メッセージを投稿する</p>
            <form action="messagePost.php" method="POST" enctype="multipart/form-data" class="text-center">
                <textarea type="text" name="content" class="p-3 w-75"></textarea>
                <input type="hidden" name="gid" value="<?= $groupId ?>">
                <button type="submit" class="btn btn-dark w-30 d-block mx-auto">投稿</button>
            </form>
        </div>
    </section>
<?php endif; ?>
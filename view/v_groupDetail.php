<?php
global $userId, $groupId, $groupInfo, $userStatus, $groupStatus, $messageInfos;
?>

<section class="mb-5 group-info">
    <h2 class="text-center my-3 heading07" data-en="Study Info">勉強会情報</h2>
    <div class="bg-light p-4 rounded shadow col-10 col-md-8 col-xl-6 mx-auto">
        <table class="maintable w-100 mb-5">
            <tbody>
                <tr>
                    <th class="p-3 w-25">TUTTI</th>
                    <td class="p-3 w-75">
                        <a href="tutti.php?tid=<?= $groupInfo['tutti_id'] ?>" class="btn btn-sm align-middle mx-1"
                            style="background-color: <?= $groupInfo['tutti_color'] ?>; color: white;">
                            <i class="<?= $groupInfo['tutti_icon'] ?>" style="color: white;"></i>
                            <span><?= $groupInfo['tutti_name'] ?></span>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th class="p-3 w-25">勉強会名</th>
                    <td class="p-3 w-75">
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
                    <td class="p-3 w-75"><?= $groupInfo['participants'] ?> / <?= $groupInfo['num_people'] ?>人</td>
                </tr>
                <tr>
                    <th class="p-3 w-25">作成者名</th>
                    <td class="p-3 w-75"><?= $groupInfo['user_name'] ?></td>
                </tr>
                <tr>
                    <th class="p-3 w-25">勉強内容</th>
                    <td class="p-3 w-75" style="white-space: pre-wrap;"><?= $groupInfo['content'] ?></td>
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
                <a href="groupLeave.php?gid=<?= $groupInfo['id'] ?>" class="btn btn-secondary btn-sm">退会</a>
            <?php endif; ?>
            <?php if ($userStatus === GROUP_OWNER): ?>
                <a href="groupEdit.php?gid=<?= $groupInfo['id'] ?>" class="btn btn-secondary btn-sm">編集</a>
                <a href="groupDelete.php?gid=<?= $groupInfo['id'] ?>" class="btn btn-secondary btn-sm ms-2">削除</a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php if ($userStatus === GROUP_MEMBER || $userStatus === GROUP_OWNER): ?>
    <section class="group-info-message mb-5">
        <h2 class="text-center my-3 heading07" data-en="Message">メッセージ</h2>
        <div class="bg-light p-4 rounded shadow col-10 col-md-8 col-xl-6 mx-auto">
            <?php if (empty($messageInfos)): ?>
                <p class="text-center py-3">まだメッセージは投稿されていません</p>
            <?php else: ?>
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
                                    <?= $messageInfo['content'] ?>
                                    <div class="d-flex justify-content-between mt-2">
                                        <small class="opacity-50"><?= $messageInfo['created_at'] ?></small>
                                        <?php if ($messageInfo['member_id'] === $userId): ?>
                                            <a href="messageDelete.php?gid=<?= $groupInfo['id'] ?>&mid=<?= $messageInfo['id'] ?>"
                                                class="btn btn-secondary btn-sm ms-2">削除</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <p class="text-center">メッセージを投稿する</p>
            <form action="messagePost.php" method="POST" enctype="multipart/form-data" class="text-center">
                <textarea type="text" name="content" class="p-1 w-75" maxlength="250" oninput="removeEmoji(this)" placeholder="投稿内容" required></textarea>
                <input type="hidden" name="gid" value="<?= $groupId ?>">
                <button type="submit" class="btn btn-dark w-30 d-block mx-auto">投稿</button>
            </form>
        </div>
    </section>
<?php endif; ?>
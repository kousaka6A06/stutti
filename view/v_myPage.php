<?php
global $userInfo, $ownerGroupInfos, $memberGroupInfos;
?>

<section class="mypage mx-auto">
    <h2 class="my-3 heading07" data-en="User">ユーザー情報</h2>
    <div class="mypage-info bg-light p-4 rounded shadow col-10 col-md-8 col-xl-6">
        <div class="col-4 col-sm-3 col-md-3 mx-auto my-2">
            <img class="w-100" src="<?= DIR_AVATAR ?><?= $userInfo['avatar'] ?>" alt="">
        </div>
        <table class="maintable w-100 my-5">
            <tbody>
                <tr>
                    <th>ユーザー名</th>
                    <td><?= $userInfo['name'] ?></td>
                </tr>
                <tr>
                    <th >メールアドレス</th>
                    <td><?= $userInfo['mail_address'] ?></td>
                </tr>
                <tr>
                    <th>StuttiID</th>
                    <td><?= $userInfo['stutti_id'] ?></td>
                </tr>
                <tr>
                    <th>パスワード</th>
                    <td>●●●●●●</td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-2">
            <a href="userEdit.php" class="btn btn-secondary btn-sm">編集</a>
            <a href="userDelete.php" class="btn btn-secondary btn-sm ms-2" onclick="return deleteUsrBeutton();">削除</a>
        </div>
    </div>
</section>
<section class="mk-studygroup mx-auto">
    <h2 class="my-3 heading07" data-en="Groups">作成した勉強会</h2>
    <div class="row my-3">
        <?php if (empty($ownerGroupInfos)): ?>
            <p class="text-center py-3">作成した勉強会は存在しません</p>
        <?php else: ?>
            <?php foreach ($ownerGroupInfos as $groupInfo): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                    <div class="card shadow">
                        <a href="groupDetail.php?gid=<?= $groupInfo['id'] ?>" class="stretched-link"></a>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-title">
                                <div class="btn btn-sm"
                                    style="background-color: <?= $groupInfo['tutti_color'] ?>; color: white;">
                                    <?= $groupInfo['tutti_name'] ?>
                                </div>
                            </li>
                        </ul>
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
        <?php endif; ?>
    </div>
</section>
<section class="edit-studygroup mx-auto mb-5">
    <h2 class="my-3 heading07" data-en="Groups">参加中の勉強会</h2>
    <div class="row my-3">
        <?php if (empty($memberGroupInfos)): ?>
            <p class="text-center pt-3">参加中の勉強会は存在しません</p>
            <small class="text-center pb-3">※作成した勉強会は除く</small>
        <?php else: ?>
            <?php foreach ($memberGroupInfos as $groupInfo): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                    <div class="card shadow">
                        <a href="groupDetail.php?gid=<?= $groupInfo['id'] ?>" class="stretched-link"></a>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-title">
                                <div>
                                    <a href="tutti.php?tid=<?= $groupInfo['tutti_id'] ?>" class="btn btn-sm"
                                        style="background-color: <?= $groupInfo['tutti_color'] ?>; color: white;">
                                        <?= $groupInfo['tutti_name'] ?>
                                    </a>
                                </div>
                            </li>
                        </ul>
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
        <?php endif; ?>
    </div>
</section>
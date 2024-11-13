<?php
global $user, $ownerGroups, $memberGroups;
?>

<h1 class="text-center py-3">マイページ</h1>

<?php if(isset($_SESSION['message'])): ?>
    <p class="text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 p-4 container"><?= $_SESSION['message'] ?></p>
    <?php unset($_SESSION['message']) ?>
<?php endif ?>

<section class="mt-5 py-3">
    <div class="container mt-3">
        <h2 class="my-3">ユーザー情報</h2>
        <div class="bg-light p-4 rounded shadow col-10 col-md-8 col-xl-6 mx-auto">
            <div class="col-6 mx-auto my-2">
                <img class="w-100" src="<?= DIR_AVATAR ?><?= $user['avatar'] ?>" alt="">
            </div>
            <table class="maintable w-100 my-4">
                <tbody>
                    <tr>
                        <th class="p-4 w-25">ユーザー名</th>
                        <td class="p-4 w-75"><?= $user['name'] ?></td>
                    </tr>
                    <tr>
                        <th class="p-4 w-25">メールアドレス</th>
                        <td class="p-4 w-75"><?= $user['mail_address'] ?></td>
                    </tr>
                    <tr>
                        <th class="p-4 w-25">StuttiID</th>
                        <td class="p-4 w-75"><?= $user['stutti_id'] ?></td>
                    </tr>
                    <tr>
                        <th class="p-4 w-25">パスワード</th>
                        <td class="p-4 w-75">●●●●●●●●</td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-2">
                <a href="userEdit.php" class="btn btn-secondary btn-sm">編集</a>
                <a href="userDelete.php" class="btn btn-secondary btn-sm ms-2">削除</a>
            </div>
        </div>
    </div>
</section>

<section class="mt-5 py-3">
    <div class="container mt-3">
        <h2 class="my-3">作成した勉強会</h2>
        <div class="row my-3">
            <?php foreach ($ownerGroups as $group): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-title">
                                <div>
                                    <a href="tutti.php?tid=<?= $group['tutti_id'] ?>" class="btn btn-sm" style="background-color: <?= $group['tutti_color'] ?>; color: white;">
                                        <?= $group['tutti_name'] ?>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <div class="card-body">
                            <h3 class="card-title"><?= $group['name'] ?></h3>
                            <p class="card-text"><?= $group['content'] ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?= $group['date'] ?>     <?= $group['time'] ?></li>
                            <li class="list-group-item"><?= $group['num_people'] ?>人</li>
                            <li class="list-group-item d-flex justify-content-end">
                                <a href="groupDetail.php?gid=<?= $group['id'] ?>>"
                                    class="btn btn-secondary btn-sm">詳しく見る</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="mt-5 py-3">
    <div class="container mt-3">
        <h2 class="my-3">参加中の勉強会</h2>
        <div class="row my-3">
            <?php foreach ($memberGroups as $group): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-title">
                                <div>
                                    <a href="tutti.php?tid=<?= $group['tutti_id'] ?>" class="btn btn-sm" style="background-color: <?= $group['tutti_color'] ?>; color: white;">
                                        <?= $group['tutti_name'] ?>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <div class="card-body">
                            <h3 class="card-title"><?= $group['name'] ?></h3>
                            <p class="card-text"><?= $group['content'] ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?= $group['date'] ?>     <?= $group['time'] ?></li>
                            <li class="list-group-item"><?= $group['num_people'] ?>人</li>
                            <li class="list-group-item d-flex justify-content-end">
                                <a href="groupDetail.php?gid=<?= $group['id'] ?>>"
                                    class="btn btn-secondary btn-sm">詳しく見る</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
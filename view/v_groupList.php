<?php
global $tuttiGroupInfos;

$tiltedKey = array_rand(array_keys($tuttiGroupInfos), 4);
?>

<section class="group-list">
    <h2 class="text-center heading07" data-en="Groups">グループ一覧</h2>
    <?php foreach ($tuttiGroupInfos as $key => $tuttiGroupInfo): ?>
        <div class="d-flex justify-content-center">
            <div class="container group-section row d-flex justify-content-center align-items-end mt-3">
                <div class="col-md-1">
                    <a href="tutti.php?tid=<?= $tuttiGroupInfo['id'] ?>" class="text-decoration-none">
                        <div class="card tutti-card2 <?= in_array($key, $tiltedKey) ? 'tilt-card' : ''; ?>"
                            style="border: 10px solid <?= $tuttiGroupInfo['color'] ?>; color: #586365">
                            <div class="card-body d-flex justify-content-center flex-column align-items-center" style="height: 160px;">
                                <h5 class="card-title vertical-text"><?= $tuttiGroupInfo['name']; ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="row mt-4">
                    <?php foreach ($tuttiGroupInfo['groups'] as $groupInfo): ?>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item list-title d-flex justify-content-end align-items-baseline ps-0 pt-0">
                                        <span class="d-flex  align-items-baseline">
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
            </div>
        </div>
    <?php endforeach; ?>
</section>


<!-- <pre>
    <?= print_r($tuttiGroupInfos); ?>
</pre> -->
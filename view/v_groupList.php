<?php
global $tuttiGroupInfos;

$tiltedKey = array_rand(array_keys($tuttiGroupInfos), 4);
?>

<section class="group-list">
    <?php foreach ($tuttiGroupInfos as $key => $tuttiGroupInfo): ?>
        <div class="d-flex justify-content-center">
            <div class="container group-section row d-flex justify-content-center align-items-end mt-3">
                <div class="col-md-1">
                    <div class="card tutti-card2 <?= in_array($key, $tiltedKey) ? 'tilt-card' : ''; ?>"
                        style="border: 10px solid <?= $tuttiGroupInfo['color'] ?>; color: #586365">
                        <div class="card-body d-flex flex-column align-items-center" style="height: 150px;">
                            <h5 class="card-title vertical-text"><?= $tuttiGroupInfo['name']; ?></h5>
                        </div>
                    </div>
                </div>
                <?php foreach ($tuttiGroupInfo['groups'] as $group): ?>
                    <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3"> -->
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body" style="height: 100px;">
                                <h3 class="card-title"><?= $group['name'] ?></h3>
                                <p class="card-text"><?= $group['content'] ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-end">
                                    <?= $group['date'] ?>
                                    <?=
                                        empty($group['start_time']) && empty($group['end_time'])
                                            ? "時間未定"
                                            :
                                                (empty($group['start_time']) ? "未定" : $group['start_time'])
                                                . "~"
                                                . (empty($group['end_time']) ? "未定" : $group['end_time'])
                                    ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-end"><?= $group['num_people'] ?>人</li>
                                <li class="list-group-item d-flex justify-content-end">
                                    <a href="groupDetail.php?gid=<?= $group['id'] ?>" class="btn btn-secondary btn-sm">詳しく見る</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- <?php foreach ($tuttiGroupInfo['groups'] as $group): ?>
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body" style="height: 100px;">
                                <h5 class="card-title">「勉強会タイトル」</h5>
                                <p class="card-text">「勉強内容」</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">「日時」</li>
                                <li class="list-group-item">「参加人数」</li>
                                <li class="list-group-item d-flex justify-content-end">
                                    <a href="groupDetail.php?gid=<?= $i+1 ?>" class="btn btn-secondary btn-sm">詳しく見る</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?> -->
            </div>
        </div>
        <?php endforeach; ?>
</section>


<!-- <pre>
    <?= print_r($tuttiGroupInfos); ?>
</pre> -->

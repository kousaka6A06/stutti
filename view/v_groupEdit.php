<?php
global $groupId, $groupInfo, $tuttiInfos;
?>

<h1 class="text-center py-3"><?= isset($groupInfo) ? "勉強会編集" : "勉強会作成" ?></h1>
<section class="container mt-3">
    <form action="groupEdit.php?gid=<?= $groupId ?>" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow mx-auto"
        style="max-width: 700px">
        <div class="mb-4">
            <label for="name" class="form-label">勉強会名を入力</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="text" id="name" name="name" class="form-control" placeholder="例：AWSの勉強しませんか？" value="<?= isset($groupInfo) ? $groupInfo['name'] : "" ?>" required>
        </div>
        <div class="mb-4">
            <label for="tutti-id" class="form-label">関連するTutti</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <select id="tutti-id" name="tutti-id" class="form-control d-table-cell" required>
                <option value="">選択してください</option>
                <?php foreach ($tuttiInfos as $tuttiInfo): ?>
                    <option value="<?= $tuttiInfo['id'] ?>"<?= isset($groupInfo) && $groupInfo['tutti_id'] === $tuttiInfo['id'] ? " selected" : "" ?>><?= $tuttiInfo['name'] ?></option>
                <?php endforeach; ?>
             </select>
        </div>
        <div class="mb-4">
            <label for="date" class="form-label">開催日</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="date" id="date" name="date" class="form-control d-table-cell" value="<?= isset($groupInfo) ? $groupInfo['date'] : "" ?>" required>
        </div>
        <div class="mb-4">
            <label for="start-time" class="form-label">開始時刻</label>
            <input type="time" name="start-time" id="start-time" class="form-control d-table-cell" value="<?= isset($groupInfo) ? $groupInfo['start_time'] : "" ?>">
        </div>
        <div class="mb-4">
            <label for="end-time" class="form-label">終了時刻</label>
            <input type="time" name="end-time" id="end-time" class="form-control d-table-cell" value="<?= isset($groupInfo) ? $groupInfo['end_time'] : "" ?>">
        </div>
        <div class="mb-4">
            <label for="location" class="form-label">開催場所</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="text" name="location" id="location" class="form-control" placeholder="例：梅田の１番街にあるカフェ" value="<?= isset($groupInfo) ? $groupInfo['location'] : "" ?>" required>
        </div>
        <div class="mb-4">
            <label for="num-people" class="form-label">参加人数</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="number" name="num-people" id="num-people" class="form-control w-25" value="<?= isset($groupInfo) ? $groupInfo['num_people'] : "" ?>" required>
        </div>
        <div class="mb-4">
            <label for="content" class="form-label">勉強内容</label>
            <small style="font-size: 10px; color: red;">*必須</small><br>
            <textarea name="content" id="content" class="form-control p-3 w-100" rows="10" required><?= isset($groupInfo) ? $groupInfo['content'] : "" ?></textarea>
        </div>
        <button type="submit" class="btn btn-dark w-30 d-block mx-auto"><?= isset($groupInfo) ? "編集する" : "作成する" ?></button>
    </form>
</section>
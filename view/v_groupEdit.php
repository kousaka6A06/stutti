<?php
global $groupId, $groupInfo, $tuttiInfos;
?>

<section class="group-edit">
    <h2 class="text-center heading07" data-en=<?= isset($groupId) ? "Edit" : "Create" ?>><?= isset($groupId) ? "勉強会を編集する" : "勉強会を作成する" ?></h2>
    <form action="groupEdit.php<?= isset($groupId) ? "?gid=" . $groupId : "" ?>" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow mx-auto"
        style="max-width: 650px">
        <div class="mb-4">
            <label for="name" class="form-label">勉強会名を入力</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="text" id="name" name="name" class="form-control" maxlength="60" onchange="removeEmoji(this)" placeholder="例：AWSの勉強しませんか？" value="<?= isset($groupInfo) ? $groupInfo['name'] : "" ?>" required>
        </div>
        <div class="mb-4">
            <label for="tutti-id" class="form-label">関連するTutti</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <select id="tutti-id" name="tutti-id" class="form-control d-table-cell" required>
                <option value="">選択してください</option>
                <?php foreach ($tuttiInfos as $tuttiInfo): ?>
                    <option value="<?= $tuttiInfo['id'] ?>"<?= isset($groupInfo) && $groupInfo['tutti_id'] == $tuttiInfo['id'] ? " selected" : "" ?>><?= $tuttiInfo['name'] ?></option>
                <?php endforeach; ?>
             </select>
        </div>
        <div class="mb-4">
            <label for="date" class="form-label">開催日</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="date" id="date" name="date" class="form-control d-table-cell" value="<?= isset($groupInfo) ? $groupInfo['date'] : "" ?>" required>
        </div>
        <div class="mb-4">
            <p id="is-time" style="color:red;"></p>
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
            <input type="text" name="location" id="location" class="form-control" maxlength="60" onchange="removeEmoji(this)" placeholder="例：梅田の１番街にあるカフェ" value="<?= isset($groupInfo) ? $groupInfo['location'] : "" ?>" required>
        </div>
        <div class="mb-4">
            <label for="num-people" class="form-label">参加人数</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="number" name="num-people" id="num-people" class="form-control w-25" max="999" min="2" value="<?= isset($groupInfo) ? $groupInfo['num_people'] : "2" ?>" required>
            <small class="ms-2"><?= isset($groupInfo) ? $groupInfo['participants'] . "人参加中" : "" ?></small>
        </div>
        <div class="mb-4">
            <label for="content" class="form-label">勉強内容</label>
            <small style="font-size: 10px; color: red;">*必須</small><br>
            <textarea name="content" id="content" class="form-control p-3 w-100" rows="10" maxlength="250" onchange="removeEmoji(this)" required><?= isset($groupInfo) ? $groupInfo['content'] : "" ?></textarea>
        </div>
        <button id="submit" type="submit" class="btn btn-dark w-30 d-block mx-auto"><?= isset($groupId) ? "編集する" : "作成する" ?></button>
    </form>
</section>
<script>
    const now = new Date();
    let today = now.getFullYear() + '-' + (now.getMonth()+1) + '-' + now.getDate();
    let startTime = document.getElementById('start-time').value;
    let endTime =document.getElementById('end-time').value;
    let isRight = true;
    
    let date = document.getElementById('date');
    date.setAttribute('min', today);
    
    document.getElementById('start-time').addEventListener('change', function(event) {
        startTime = document.getElementById('start-time').value;
        if(startTime && endTime) {
            endTime = document.getElementById('end-time').value;
            satrtTimeFull = new Date(today + "T" +startTime + ":00");
            endTimeFull = new Date(today + "T" +endTime + ":00");
            if(satrtTimeFull < endTimeFull) {
                isRight = true;
                document.getElementById('is-time').innerHTML = '';
            } else {
                isRight = false;
                console.log(isRight);
                document.getElementById('is-time').innerHTML = '終了時刻は開始時刻より未来の日付を設定してください。';
            }
        } else if(!startTime) {
            isRight = true;
            document.getElementById('is-time').innerHTML = '';
        }
    });
    document.getElementById('end-time').addEventListener('change', function(event) {
        endTime =document.getElementById('end-time').value;
        if(startTime && endTime) {
           startTime = document.getElementById('start-time').value;
           satrtTimeFull = new Date(today + "T" +startTime + ":00");
           endTimeFull = new Date(today + "T" +endTime + ":00");
           console.log(satrtTimeFull);
           console.log(endTimeFull);
           if(satrtTimeFull < endTimeFull) {
                isRight = true;
                document.getElementById('is-time').innerHTML = '';
            } else {
                isRight = false;
                console.log(isRight);
                document.getElementById('is-time').innerHTML = '終了時刻は開始時刻より未来の日付を設定してください。';
            }
        } else if(!endTime) {
            isRight = true;
            document.getElementById('is-time').innerHTML = '';
        } 
        
    });
    document.getElementById('submit').addEventListener('click', function(event) {
        if(isRight === false) {
            event.preventDefault();
        }
    });

</script>
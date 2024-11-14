<?php
global $userInfo;
?>

<section class="container mt-3">
    <h1 class="text-center py-3">ユーザー編集</h1>

    <div class="col-4 mx-auto my-2">
        <img class="w-100" src="<?= DIR_AVATAR ?><?= $user['avatar'] ?>" alt="">
    </div>
    <form action="userEdit.php" method="POST" enctype="multipart/form-data"
        class="bg-light p-4 rounded shadow mx-auto" style="max-width: 700px">
        <div class="mb-4">
          <label for="name" class="form-label">ユーザー名を入力</label>
          <small style="font-size: 10px; color: red;">*必須</small>
          <input type="text" id="name" name="name" class="form-control" value="<?= $user['name'] ?>" required>
        </div>
        <div class="mb-4">
            <label for="mail-address" class="form-label">メールアドレスを入力</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="email" id="mail-address" name="mail-address" class="form-control"
                placeholder="example@mail.com" value="<?= $user['mail_address'] ?>" required>
        </div>
        <div class="mb-4">
          <label for="avatar" class="form-label">プロフィール画像を変更したい場合、アップロードしてください</label>
            <input type="hidden" name="max_file_size" value="1000000">
            <input type="file" id="avatar" name="avatar" class="form-control">
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">ログインパスワードを入力</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="password" id="password" name="password" class="form-control" required>
            <small class="form-text text-muted">（英数字 8 〜 12文字以内,特殊文字や記号は使用不可）</small>
        </div>
        <div class="mb-4">
            <label for="confirmPassword" class="form-label">確認のため再度入力してください</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-dark w-30 d-block mx-auto">修正する</button>
    </form>
</section>
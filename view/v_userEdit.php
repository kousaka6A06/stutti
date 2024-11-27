<?php
global $userInfo;
?>

<section class="">
    <h1 class="text-center">ユーザー編集</h1>
    <div class="col-4 mx-auto my-2">
        <img class="w-100" src="<?= DIR_AVATAR ?><?= $userInfo['avatar'] ?>" alt="">
    </div>
    <form action="userEdit.php" method="POST" enctype="multipart/form-data"
        class="bg-light p-4 rounded shadow mx-auto" style="max-width: 700px">
        <div class="mb-4">
          <label for="name" class="form-label">ユーザー名を入力</label>
          <small style="font-size: 10px; color: red;">*必須</small>
          <input type="text" id="name" name="name" class="form-control" value="<?= $userInfo['name'] ?>" maxlength="90" oninput="removeEmoji(this)" required>
        </div>
        <div class="mb-4">
            <label for="mail-address" class="form-label">メールアドレスを入力</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="email" id="mail-address" name="mail-address" class="form-control" maxlength="90" oninput="removeEmoji(this)" 
                placeholder="example@mail.com" value="<?= $userInfo['mail_address'] ?>" required>
        </div>
        <div class="mb-4">
          <label for="avatar" class="form-label">プロフィール画像を変更したい場合、アップロードしてください</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
            <input type="file" id="avatar" name="avatar" class="form-control">
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">ログインパスワードを入力</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <p id="passAl1" style="color:red;"></p>
            <p id="passAl2" style="color:red;"></p>
            <input type="password" id="password" name="password" class="form-control" required>
            <small class="form-text text-muted">（英大文字・英小文字・数字・記号(!@;:)の4種類の文字種のうち3種類を含む8文字以上）</small>
        </div>
        <div class="mb-4">
            <label for="confirmPassword" class="form-label">確認のため再度入力してください</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
        </div>
        <button type="submit" id="submit" class="btn btn-dark w-30 d-block mx-auto">修正する</button>
    </form>
</section>
<script>
    let isRight = true;
    let passPattern = /^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])|(?=.*[a-z])(?=.*[A-Z])(?=.*[!@;:])|(?=.*[A-Z])(?=.*[0-9])(?=.*[!@;:])|(?=.*[a-z])(?=.*[0-9])(?=.*[!@;:]))([a-zA-Z0-9!@;:]){8,}$/;
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('confirmPassword').value;
    document.getElementById('password').addEventListener('change', function(event) {
        password = document.getElementById('password').value;
        confirmPassword = document.getElementById('confirmPassword').value;
        if(passPattern.test(password)){
            if(confirmPassword){
                if (password === confirmPassword) {
                    document.getElementById('passAl2').innerHTML = '';
                    document.getElementById('passAl1').innerHTML = '';
                    isRight = true;
                } else {
                    document.getElementById('passAl2').innerHTML = '再入力されたパスワードが一致しません。';
                    isRight = false;
                }
            } else {
                document.getElementById('passAl1').innerHTML = '';
                isRight = true;
            }
        } else {
            document.getElementById('passAl1').innerHTML = 'パスワードは8文字以上、英大文字・英小文字・数字・記号の4種類の文字種のうち3種類を含むようご入力ください。';
            isRight = false;
        }

    });
    document.getElementById('confirmPassword').addEventListener('change', function(event) {
        password = document.getElementById('password').value;
        confirmPassword = document.getElementById('confirmPassword').value;
        if (password === confirmPassword) {
            if(passPattern.test(confirmPassword)) {
                document.getElementById('passAl1').innerHTML = '';
                document.getElementById('passAl2').innerHTML = '';
                isRight = true;
            } else {
                document.getElementById('passAl2').innerHTML = '';
                document.getElementById('passAl1').innerHTML = 'パスワードは8文字以上、英大文字・英小文字・数字・記号の4種類の文字種のうち3種類を含むようご入力ください。';
                isRight = false;
            }
        } else {
            document.getElementById('passAl2').innerHTML = '再入力されたパスワードが一致しません。';
            isRight = false;
        }
    });
    document.getElementById('submit').addEventListener('click', function(event) {
        if(isRight === false) {
            event.preventDefault();
        }
    });
</script>
<?php
global $userInfo;
?>

<section class="">
    <form action="userRegister.php" method="POST" enctype="multipart/form-data"
        class="bg-light p-4 rounded shadow mx-auto" style="max-width: 700px">
        <div class="mb-4">
            <label for="name" class="form-label">ユーザー名を入力</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="text" id="name" name="name" class="form-control" maxlength="90" onchange="removeEmoji(this)" 
                value="<?= isset($userInfo) ? $userInfo['name'] : "" ?>" required>
        </div>
        <div class="mb-4">
            <label for="mail-address" class="form-label">メールアドレスを入力</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <input type="email" id="mail-address" name="mail-address" class="form-control" maxlength="90" 
                placeholder="example@mail.com" value="<?= isset($userInfo) ? $userInfo['mail_address'] : "" ?>"
                required>
        </div>
        <div class="mb-4">
            <label for="avatar" class="form-label">プロフィール画像をアップロードできます</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
            <input type="file" id="avatar" name="avatar" class="form-control">
        </div>
        <div class="mb-4">
            <label for="stutti-id" class="form-label">Stutti IDを入力</label>
            <small style="font-size: 10px; color: red;">*必須</small>
            <small>ログイン時に必要になります</small>
            <input type="text" id="stutti-id" name="stutti-id" class="form-control" maxlength="90" onchange="removeEmoji(this)" 
                value="<?= isset($userInfo) ? $userInfo['stutti_id'] : "" ?>" required>
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
        <div class="mb-4">
            <label for="terms" class="form-label">利用規約・プライバシーポリシー</label>
            <div id="terms" class="form-control" style="height: 200px; overflow-y: scroll;">
                <p><strong>利用規約</strong><br><br>
                <p><strong>第1条（目的）</strong><br>
                    この利用規約は、Stutti（以下「当サービス」）の利用条件を定めるものです。
                    当サービスを利用するすべてのユーザー（以下「ユーザー」）は、本規約に同意したものとみなされます。<br></p>
                <p><strong>第2条（登録）</strong><br>
                    当サービスの利用を希望する者は、所定の方法によりメンバー登録を行うものとします。登録に際しては、正確かつ最新の情報を提供するものとします。
                    登録内容に虚偽、誤りがある場合、当サービスは登録を削除する権利を有します。<br></p>
                <p><strong>第3条（アカウント管理）</strong><br>
                    ユーザーは、自己の責任において、StuttiIDおよびパスワードを管理するものとします。
                    アカウントの不正使用による損害について、当サービスは一切責任を負いません。<br></p>
                <p><strong>第4条（禁止事項）</strong><br>
                    法令または公序良俗に違反する行為<br>
                    当サービスの運営を妨害する行為<br>
                    他のユーザーまたは第三者の権利を侵害する行為<br>
                    他のユーザーの個人情報を不正に取得、利用する行為<br></p>
                <p><strong>第5条（サービスの変更・停止）</strong><br>
                    当サービスは、ユーザーに通知することなく、サービス内容の変更、追加、または停止を行うことができるものとします。<br></p>
                <p><strong>第6条（免責事項）</strong><br>
                    当サービスは、ユーザーによる利用に関して生じた一切の損害について、責任を負いません。
                    当サービスは、提供する情報の正確性、完全性、有用性を保証しません。<br></p>
                <p><strong>第7条（プライバシー）</strong><br>
                    ユーザーの個人情報の取り扱いについては、別途定めるプライバシーポリシーに従うものとします。<br></p>
                <p><strong>第8条（規約の変更）</strong><br>
                    当サービスは、本規約を随時変更することができるものとします。変更後の規約は、当サービス上に掲示した時点で効力を生じるものとします。<br></p>
                <p><strong>第9条（準拠法および管轄）</strong><br>
                    本規約は、日本法に基づき解釈されるものとし、ユーザーと当サービスの間で生じた紛争については、日本の裁判所を専属的合意管轄とします。<br><br><br></p>

                <p><strong>プライバシーポリシー</strong><br><br>
                <p><strong>第1条（個人情報の収集）</strong><br>
                    当サービスは、ユーザーの個人情報を以下の方法で収集します。
                    メンバー登録時に提供される情報（メールアドレス、パスワード、アバター画像など）
                    サービス利用中に提供される情報（勉強会参加情報、メッセージ内容など）<br></p>
                <p><strong>第2条（個人情報の利用目的）</strong><br>
                    収集した個人情報は、以下の目的で利用します。
                    ユーザーサポート<br>
                    サービス改善および新機能の開発<br>
                    利用状況の分析および統計データの作成<br></p>
                <p><strong>第3条（個人情報の第三者提供）</strong><br>
                    ユーザーの同意がある場合<br>
                    ユーザーサポート<br>
                    法令に基づく場合<br></p>
                <p><strong>第4条（個人情報の管理）</strong><br>
                    当サービスは、ユーザーの個人情報を適切に管理し、外部からの不正アクセス、紛失、破壊、改ざん、漏洩を防止するために必要な措置を講じます。<br></p>
                <p><strong>第5条（個人情報の開示・訂正・削除</strong><br>
                    ユーザーは、自己の個人情報の開示、訂正、削除を希望する場合、当サービスの定める手続きにより請求することができます。<br></p>
                <p><strong>第6条（プライバシーポリシーの変更）</strong><br>
                    当サービスは、本プライバシーポリシーを随時変更することができます。変更後の内容は、当サービス上に掲示した時点で効力を生じるものとします。<br></p>
                <p><strong>第7条（お問い合わせ）</strong><br>
                    個人情報の取扱いに関するお問い合わせは、以下の連絡先までお願いします。<br>
                    メールアドレス:privacy@stutti.net<br></p>
            </div>
        </div>
        <div class="form-check mb-4">
            <input type="checkbox" id="agree" name="agree" class="form-check-input" <?= isset($userInfo) ? " checked" : "" ?> required>
            <label for="agree" class="form-check-label">利用規約・プライバシーポリシーに同意する</label>
        </div>
        <button type="submit" id="submit" class="btn btn-dark w-30 d-block mx-auto">登録する</button>
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
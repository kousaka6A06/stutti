<section class="container mt-1">
  <h2 class="text-center">メンバー登録</h2>
  <form action="registerMember.php" method="POST" onsubmit="return confirmForm();" enctype="multipart/form-data"
    class="bg-light p-4 rounded shadow w-50 mx-auto">
    <div class="mb-3">
      <label for="memberId" class="form-label">メールアドレスを入力</label>
      <small style="font-size: 10px; color: red;">*必須</small>
      <input type="email" id="memberId" name="memberId" class="form-control" placeholder="example@mail.com" required>
    </div>

    <div class="mb-3">
      <label for="memberId" class="form-label">ログインIDを入力</label>
      <small style="font-size: 10px; color: red;">*必須</small>
      <small>ログイン時に必要になります</small>
      <input type="email" id="memberId" name="memberId" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="handleName" class="form-label">ニックネームを入力</label>
      <small style="font-size: 10px; color: red;">*必須</small>
      <input type="text" id="handleName" name="handleName" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="file" class="form-label">アバター画像をアップロードできます</label>
      <input type="hidden" name="max_file_size" value="1000000">
      <input id="upfile" type="file" name="upfile" class="form-control">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">ログインパスワードを入力</label>
      <small style="font-size: 10px; color: red;">*必須</small>
      <input type="password" name="password" id="password" class="form-control" required>
      <small class="form-text text-muted">（英数字 8 〜 12文字以内,特殊文字や記号は使用不可）</small>
    </div>

    <div class="mb-3">
      <label for="confirmPassword" class="form-label">確認のため再度入力してください</label>
      <small style="font-size: 10px; color: red;">*必須</small>
      <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="terms" class="form-label">利用規約</label>
      <div id="terms" class="form-control" style="height: 200px; overflow-y: scroll;">
        この利用規約（以下，「本規約」といいます。）は，Stutti（以下，「当社」といいます。）が
        このウェブサイト上で提供するサービス（以下，「本サービス」といいます。）の利用条件を定めるものです。
        </p>
        <p>登録ユーザーの皆さま（以下，「ユーザー」といいます。）には，本規約に従って，本サービスをご利用いただきます。</p>

        <p><strong>第1条（適用）</strong><br>
          本規約は，ユーザーと当社との間の本サービスの利用に関わる一切の関係に適用されるものとします。</p>
      </div>
    </div>

    <div class="form-check mb-3">
      <input type="checkbox" id="agree" name="agree" class="form-check-input" required>
      <label for="agree" class="form-check-label">利用規約に同意する</label>
    </div>

    <button type="submit" class="btn btn-dark w-30 d-block mx-auto">登録する</button>
  </form>

  <hr>

</section>
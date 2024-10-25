<section class="container mt-1">
    <h2 class="text-center">ログイン</h2>
    <p class="fs-10 text-muted text-center">メンバー登録は
        <a href="input_register.php" class="text-info fw-bold">こちら</a>
    </p>
    
    <form action="login.php" method="POST">
        <div class="bg-light p-4 rounded shadow w-50 mx-auto">

            <div class="mb-3">
                <label for="memberId" class="form-label">メールアドレスを入力</label>
                <input type="email" name="memberId" id="memberId" class="form-control" placeholder="example@mail.com"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">パスワードを入力</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-dark d-block mx-auto">ログイン</button>
        </div>
    </form>
    <hr>
    <!-- <div class="text-center mt-3">
    <a href="index.php" class="btn btn-outline-secondary">トップに戻る</a>
  </div> -->
</section>
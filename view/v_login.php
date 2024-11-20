<section class="container-md">
    <h1 class="text-center">ログイン</h1>
    <p class="fs-10 text-muted text-center">ユーザー登録は
        <a href="userRegister.php" class="text-info fw-bold">こちら</a>
    </p>
    <form action="login.php" method="POST">
        <div class="bg-light p-4 rounded shadow container" style="max-width: 700px">
            <div class="mb-3">
                <label for="stutti-id" class="form-label">Stutti IDを入力</label>
                <input type="text" name="stutti-id" id="stutti-id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">パスワードを入力</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark d-block mx-auto">ログイン</button>
        </div>
    </form>
</section>
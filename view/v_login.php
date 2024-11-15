<section class="container mt-3">
    <h1 class="text-center py-3">ログイン</h1>
    <p class="fs-10 text-muted text-center">ユーザー登録は
        <a href="userRegister.php" class="text-info fw-bold">こちら</a>
    </p>

    <?php if(isset($_SESSION['message'])): ?>
        <p class="text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 p-4 container" style="max-width: 700px"><?= $_SESSION['message'] ?></p>
        <?php unset($_SESSION['message']) ?>
    <?php endif ?>

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
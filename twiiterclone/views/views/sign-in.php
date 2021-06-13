
<!DOCTYPE html>
<html lang="ja">
<head>

    <?php include_once('../views/common/head.php'); ?>
    <title>ログイン画面/twitterクローン</title>
    <meta name="description" content="ログイン画面です">
</head>

<body class="signup text-center">
    <main class="form-signup">
        <form action="sign-in.php" method="post">
            <img src="/twitterClone/views/img/logo-white.svg" alt="" class="logo-white">
            <h1>Twitterクローンにログイン</h1>

            <?php if(isset($view_try_login_result) && $view_try_login_result === false): ?>
            <!-- ログインに失敗した場合 -->
            <div class="alert alert-warning text-sm" role="alert">
            ログインに失敗しました。メールアドレス、パスワードが正しいか以下ご確認ください。
            </div>
            <?php endif; ?>
            <input type="email" class="form-control" name="email" placeholder="メールアドレス" require autofocus>
            <input type="password" class="form-control" name="password" placeholder="パスワード" require>
            <button class="w-100 btn btn-lg" type="submit">ログインする</button>
            <p class="mt-3 mb-2"><a href="sign-up.php">会員登録する</a></p>
            <p class="mt-2 mb-3 text-muted">&copy; 2021</p>


        </form>
    </main>
    <?php include_once('../views/common/foot.php'); ?>
</body>

</html>
<?php $title = '來！' ?>
<?php include __DIR__ . '/php_parts/config.php' ?>

<!-- 這裡是自己的php -->
<!-- 這邊之後會連結資料庫，抓所有會員資料 -->
<!-- 第一個if是判斷有沒有表單資料（post)送過來,帳號跟密碼都有送資料isset -->
<?php
if (isset($_POST['account']) and isset($_POST['password'])) {
    if ($_POST['account'] === 'jin' and $_POST['password'] === '1234') {
        $_SESSION['user'] = [
            'account' => 'jin',
            'nickname' => '金金',
        ];
    } else {
        $msg = '帳號或密碼錯誤';
    }
}

?>


<!-- 這裡開始就是html -->
<?php include __DIR__ . '/php_parts/html.head.php'; ?>
<?php include __DIR__ . '/php_parts/html.nav.php'; ?>



<div class="container">


    <row>
        <div class="col-lg-6">
            <!-- alert -->
            <?php if (isset($msg)) : ?>
                <div class="alert alert-primary" role="alert">
                    <!-- 呈現else的警告文字 -->
                    <?= $msg ?>
                </div>

            <?php endif; ?>


            <div class="card" ">
                <div class=" card-body">
                <h5 class="card-title">Card title</h5>

                <!-- 如果有登入就秀下面的歡迎文字-->
                <?php if (isset($_SESSION['user'])) : ?>
                    <h3><?= $_SESSION['user']['nickname'] ?>哈囉</h3>
                    <!-- 這邊可以放登出的按鈕，連到登出的頁面 -->
                    <p><a href="21.log-out-session.php">登出</a></p>

                    <!-- 如果沒有登入才秀表單-->
                <?php else : ?>

                    <form action="" method="post">
                        <!-- method如果沒有設定，預設是get, 但會直接出現在網址列，所以一班會用post -->
                        <!-- 沒有name的欄位就不能送值出去！ -->
                        <!-- 沒有action，代表送出去給自己，或是空字串 -->


                        <div class="form-group">
                            <!-- for 對應到id，不是name -->
                            <!-- 因為label有下for，所以點label的文字，input框也會拿到focus -->
                            <label for="account">account</label>
                            <!-- **** 如果帳密打錯，會顯示原本打錯的帳密，讓使用者可以做修改, 就要在value那邊設定 -->
                            <input type="text" class=" form-control" id="account" name="account" value="    <?= isset($_POST['account']) ? htmlentities($_POST['account']) : '' ?>">




                            <!-- 把打出的密碼秀在下面 -->
                            <small class="form-text"></small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>

                            <!-- htmlemtities 是html的跳脫"" 方式，避免有人在input欄打帶有"的文字時，會影響value的呈現 -->
                            <!-- **** 如果帳密打錯，會顯示原本打錯的帳密，讓使用者可以做修改, 就要在value那邊設定 -->
                            <input type="password" class="form-control" id="password" name="password" value="<?= isset($_POST['password']) ? htmlentities($_POST['password']) : '' ?>">
                            <!-- 把打出的密碼秀在下面 -->
                            <small class=" form-text"></small>
                        </div>


                        <div class="form-group form-check">
                            <!-- check-box可以給value的值，送出後就會是那個值 -->
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="exampleCheck1" value="是">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                <?php endif; ?>

            </div>
        </div>



</div>
</row>
</div>

<?php include __DIR__ . '/php_parts/html.script.php'; ?>
<?php include __DIR__ . '/php_parts/html.footer.php'; ?>
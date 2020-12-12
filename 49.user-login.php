<?php $title = '登入頁面' ?>
<?php include __DIR__ . '/php_parts/config.php' ?>

<!-- 這裡是自己的php -->
<!-- login page 這邊要讓上面的navbar顯示登入後的名字 -->
<?php
if (isset($_SESSION['user'])) {
    header('Location: 37.product-list.php');
    exit;
}

// 這邊設定從哪邊來，登入後就回到哪邊去
if (isset($_SERVER['HTTP_REFERER'])) {
    $gotoURL = $_SERVER['HTTP_REFERER'];
} else { //如果沒有的話，就一律回到商品列表
    $gotoURL = '37.product-list.php';
}

?>

<!-- 這裡開始就是html -->
<?php include __DIR__ . '/php_parts/html.head.php'; ?>

<!-- 這裡要把JQ動態搬到前面，因為nav購物車小數量需要JQ動態才能呈現 -->
<?php include __DIR__ . '/php_parts/html.script.php'; ?>
<?php include __DIR__ . '/php_parts/html.nav-proj.php'; ?>



<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <!-- 彈跳 -->
            <div id="info_bar" class="alert alert-danger" role="alert" style="display: none">
            </div>

            <!-- 登入卡片開始 -->
            <div class="card">
                <div class=" card-body">
                    <h5 class="card-title">會員登入</h5>

                    <form name="form1" onsubmit="checkForm(); return false;">
                        <!-- 帳號欄位 -->
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <small class="form-text"></small>
                        </div>
                        <!-- 密碼欄位 -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="form-text"></small>
                        </div>

                        <!-- 按鈕 -->
                        <button type="submit" class="btn btn-primary">登入</button>
                    </form>

                </div>
            </div>



        </div>
    </div>
</div>


<script>
    const email = $('#email'),
        password = $('#password'),
        info_bar = $('#info_bar')

    function checkForm() {

        $.post('50.user-login-api.php', {
            email: email.val(),
            password: password.val()
        }, function(data) {
            console.log(data);

            // 登入成功或失敗的提醒
            if (data.success) {
                info_bar
                    .removeClass('alert-danger')
                    .addClass('alert-success')
                    .text('登入成功');

                // 改成<= $gotoURL ?>，最上面設定的function，紀錄從哪裡來，從哪裡回去
                location.href = '<?= $gotoURL ?>';

            } else {
                // 這邊是設定如果新增失敗就出現alert框框
                info_bar
                    // data.error || '新增失敗' 意思是如果有就用data.error的訊息，如果沒有就用"新增失敗的字串"
                    .text(data.error || '登入失敗')
                    .removeClass('alert-success')
                    .addClass('alert-danger');
            }
            // 這邊是設定alert框框用滑出的方式出現
            info_bar.slideDown();

            // 這邊是設定alert框框滑出幾秒後要上滑消失
            setTimeout(function() {
                info_bar.slideUp();
            }, 2000);

        }, 'json');
    }
</script>
<?php include __DIR__ . '/php_parts/html.footer.php'; ?>
<?php $title = '登入頁面' ?>
<?php include __DIR__ . '/php_parts/config.php' ?>

<!-- 這裡是自己的php -->
<!-- login page 這邊要讓上面的navbar顯示登入後的名字 -->
<?php
if (isset($_SESSION['admin'])) {
    header('Location: 22.ab-list.php');
    exit;
}

?>

<!-- 這裡開始就是html -->
<?php include __DIR__ . '/php_parts/html.head.php'; ?>
<?php include __DIR__ . '/php_parts/html.nav.php'; ?>



<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <!-- 彈跳 -->
            <div id="info_bar" class="alert alert-danger" role="alert" style="display: none">
            </div>

            <!-- 登入卡片開始 -->
            <div class="card">
                <div class=" card-body">
                    <h5 class="card-title">管理通訊錄-登入</h5>

                    <form name="form1" onsubmit="checkForm(); return false;">
                        <!-- 帳號欄位 -->
                        <div class="form-group">
                            <label for="account">account</label>
                            <input type="text" class="form-control" id="account" name="account">
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

<?php include __DIR__ . '/php_parts/html.script.php'; ?>

<script>
    const account = $('#account'),
        password = $('#password'),
        info_bar = $('#info_bar')

    function checkForm() {

        $.post('30.ab-login-api.php', {
            account: account.val(),
            password: password.val()
        }, function(data) {
            console.log(data);

            // 登入成功或失敗的提醒
            if (data.success) {

                // 這邊是設定如果新增成功就出現alert框框
                // info_bar
                //     .removeClass('alert-danger')
                //     .addClass('alert-success')
                //     .text('登入成功');

                // 也可以不跳上面的提醒，成功登入後叫它直接轉向到列表頁
                location.href = "22.ab-list.php";

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
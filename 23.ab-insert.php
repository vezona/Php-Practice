<?php $title = '來！' ?>
<?php include __DIR__ . '/php_parts/config.php' ?>

<!-- 這裡是自己的php -->
<!-- 這邊之後會連結資料庫，抓所有會員資料 -->
<!-- 第一個if是判斷有沒有表單資料（post)送過來,帳號跟密碼都有送資料isset -->
<?php

// 設定登入時才能動作
require __DIR__ . '/php_parts/admin-required.php';

// 這邊設定這個頁面的名稱，這樣切換到這個頁面的時候，header檔裡面的active才能作用
$pageName = 'ab-insert';

?>


<!-- 這裡開始就是html -->
<?php include __DIR__ . '/php_parts/html.head.php'; ?>
<?php include __DIR__ . '/php_parts/html.nav.php'; ?>


<!-- 自己的css開始 -->

<style>
    small.form-text {
        color: red;
    }
</style>


<div class="container mt-3">

    <row>
        <div class="col-lg-6">
            <!-- alert -->

            <div id="info-bar" class="alert alert-danger" role="alert" style="display:none;">
                <!-- 呈現else的警告文字 -->

            </div>




            <div class="card">
                <div class=" card-body">
                    <h5 class="card-title">新增通訊資料</h5>

                    <!-- novalidate 不用預設的方式檢查，全部用JS下面設定的checkForm()來檢查 -->
                    <form name="form1" onsubmit="checkForm();return false;" novalidate>
                        <!-- return 用在function回傳值，行內的事件處裡器（onsubmit/onclick等等）在底層運作是包含在一個function -->
                        <!-- return false 是 避免回傳預設值，類似prevent default，這邊是要避免表單用傳統方式傳出去 -->
                        <!-- 丟掉action="24.ab-insert-api.php" method="post"，因為要用Ajax送，不用傳統的表單方式送資料 -->
                        <!-- checkForm() 這邊就是用自己設定的Ajax 函式傳資料出去 -->

                        <!-- 取input內的值，document.form1.name.value  (原生的JS用.value, JQ用.val);下面的checkForm()用ＪＱ設定，所以要用.val -->

                        <!-- method如果沒有設定，預設是get, 但會直接出現在網址列，所以一班會用post -->
                        <!-- 沒有name的欄位就不能送值出去！ -->
                        <!-- 沒有action，代表送出去給自己，或是空字串 -->

                        <!-- name -->
                        <div class="form-group">
                            <label for="name">name</label>
                            <!-- 下required就會強制要填這個欄位 -->
                            <input type="text" class="form-control" id="name" name="name" required>
                            <small class="form-text"></small>
                        </div>


                        <!-- email -->
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <small class="form-text"></small>
                        </div>


                        <!-- mobile -->
                        <div class="form-group">
                            <label for="mobile">手機</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
                            <small class="form-text"></small>
                        </div>


                        <!-- birthday -->
                        <div class="form-group">
                            <label for="birthday">生日</label>
                            <input type="date" class=" form-control" id="birthday" name="birthday">
                            <small class="form-text"></small>
                        </div>


                        <!-- address -->
                        <div class="form-group">
                            <label for="account">address</label>
                            <textarea class=" form-control" name="address" id="address" cols="30" rows="3"></textarea>
                            <small class="form-text"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>



                </div>
            </div>



        </div>
    </row>
</div>

<?php include __DIR__ . '/php_parts/html.script.php'; ?>

<!-- 這邊放自己要的ＪＳ -->
<script>
    // 正規表示法設定email的格式
    // 也可在input標籤內放入pattern="" (但要去掉斜線)
    const email_re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;


    // 設定常數
    const name = $('#name'),
        email = $('#email'),
        info_bar = $('#info-bar');


    function checkForm() {
        // 呼叫的時候先清掉其他緊告
        name.next().text('')
        email.next().text('')

        // 檢查有沒有通過，檢查姓名長度跟email格式
        let isPass = true;

        // 如果拿到的姓名的長度小於2，就不通過
        if (name.val().length < 2) {
            isPass = false;

            // 這邊設定下面small的小警告出現的文字
            // 小警告的位置是name的next (JQ select注意！)
            name.next().text('請填寫正確姓名')
        }

        // 如果拿到的email格式不正確，就不通過
        // 用正規表示法的.test()去看輸入的內容是否正確
        console.log(email.val());
        // 檢查是否有抓到email的值

        if (email.val()) {
            // 如果email裡面有填值，就檢查
            if (!email_re.test(email.val())) {
                isPass = false;
                email.next().text('請填寫正確信箱');

            }
        }

        // 如果檢查都通過
        // 用JQ的Ajax方式去寫，Ajax是非同步，所以可以不重整頁面的情況下刷新部分資料
        // 會用到兩個函式 JQ.get / JQ.post  ＝> $.post $.get
        if (isPass) {
            //ajax
            // 完成後,function(data)會被呼叫，然後執行{}裡面的動作
            // {name:1,email:'bb'}換成JQ.serialize的功能，能把整個表單內所有有效欄位轉換格式，才不用一個個打，萬一要的欄位多就很累
            // $.post(裡面有四個參數，第一個是要發去哪個頁面，再來是取得的資料欄位，之後是取到後要執行的function，最後是變成json字串)
            $.post('24.ab-insert-api.php', $(document.form1).serialize(), function(data) {
                console.log(data);
                // 這邊是24.api裡面那個success，data是傳入這個function的參數
                if (data.success) {

                    // 這邊是設定如果新增成功就出現alert框框
                    info_bar
                        .text('完成新增')
                        .removeClass('alert-danger')
                        .addClass('alert-success');
                } else {
                    // 這邊是設定如果新增失敗就出現alert框框
                    info_bar
                        // data.error || '新增失敗' 意思是如果有就用data.error的訊息，如果沒有就用"新增失敗的字串"
                        .text(data.error || '新增失敗')
                        .removeClass('alert-success')
                        .addClass('alert-danger');

                }
                // 這邊是設定alert框框用滑出的方式出現
                info_bar.slideDown();

                // 這邊是設定alert框框滑出幾秒後要上滑消失
                setTimeout(function() {
                    info_bar.slideUp();
                }, 2000);

                // 這邊第四個參數，代表傳回來的字串自動幫我做json parse，從字串換成json格式
            }, 'json')
        }

    }
</script>

<?php include __DIR__ . '/php_parts/html.footer.php'; ?>
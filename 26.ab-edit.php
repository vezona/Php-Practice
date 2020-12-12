<?php $title = '來！' ?>
<?php include __DIR__ . '/php_parts/config.php' ?>



<!-- 編輯與新增ab-insert類似，用它來改 -->

<!-- 這裡是自己的php -->
<?php
// 設定登入時才能動作
require __DIR__ . '/php_parts/admin-required.php';


// 編輯時一定是點了某筆資料然後才進到那筆資料的編輯葉。所以這邊要指定要抓哪筆資料帶進來
// 如果有sid有資料的話，就把裡面的資料變成整數
if (isset($_GET['sid'])) {
    // 這邊把取得的sid變成整數
    $sid = intval($_GET['sid']);
    // 如果sid沒有資料的話
} else {
    // 如果沒有要刪，就回到原本畫面
    header('Location:22.ab-list.php');
    // 一定要exit，不然會繼續執行下面的php，不會轉向到要去的頁面
    exit;
}

// 要拿到要修改的那一筆
$sql = "SELECT * FROM `address_book`WHERE sid=$sid";
// query是拿到statment物件 ，然後再去fetch
$row = $pdo->query($sql)->fetch();

// 如果沒拿到資料，如果row是空的
if (empty($row)) {
    // 就回到列表頁，什麼事情都不做
    header('Location:22.ab-list.php');
}

// 這邊是測試，按編輯後會跳出那個sid資料的json檔
// echo json_encode($row);
// exit;


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
                    <h5 class="card-title">編輯資料</h5>

                    <!-- novalidate 不用預設的方式檢查，全部用JS下面設定的checkForm()來檢查 -->
                    <form name="form1" onsubmit="checkForm();return false;" novalidate>

                        <!-- 額外加一個隱藏欄位，目的是告訴後端現在要修改哪裡 -->
                        <!-- 這個隱藏欄位必須要加在from中，不然不會起作用 -->
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">


                        <!-- name -->
                        <div class="form-group">
                            <label for="name">name</label>
                            <!-- 下required就會強制要填這個欄位 -->
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>" required>
                            <small class="form-text"></small>
                        </div>


                        <!-- email -->
                        <div class="form-group">
                            <label for="email">email</label>
                            <!-- 現在要在value設定點到指定的sid要帶進來的值 -->
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlentities($row['email']) ?>">
                            <small class="form-text"></small>
                        </div>


                        <!-- mobile -->
                        <div class="form-group">
                            <label for="mobile">手機</label>
                            <!-- 現在要在value設定點到指定的sid要帶進來的值 -->
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?= htmlentities($row['mobile']) ?>">
                            <small class="form-text"></small>
                        </div>


                        <!-- birthday -->
                        <div class="form-group">
                            <label for="birthday">生日</label>
                            <!-- 現在要在value設定點到指定的sid要帶進來的值 -->
                            <input type="date" class=" form-control" id="birthday" name="birthday" value="<?= htmlentities($row['birthday']) ?>">
                            <small class="form-text"></small>
                        </div>


                        <!-- address -->
                        <div class="form-group">
                            <label for="address">address</label>
                            <!-- 現在要在value設定點到指定的sid要帶進來的值 -->
                            <!-- textarea比較特別，value去掉value的標籤直接放在<textarea> 中間 </textarea> 
                        而且中間不要有任何空白，否則會算進呈現的字元-->
                            <textarea class=" form-control" name="address" id="address" cols="30" rows="3"> <?= htmlentities($row['address']) ?></textarea>
                            <small class="form-text"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">修改</button>
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
            $.post('28.ab-edit-api.php', $(document.form1).serialize(), function(data) {
                console.log(data);
                // 這邊是24.api裡面那個success，data是傳入這個function的參數
                if (data.success) {

                    // 這邊是設定如果新增成功就出現alert框框
                    info_bar
                        .text('修改完成')
                        .removeClass('alert-danger')
                        .addClass('alert-success');
                } else {
                    // 這邊是設定如果新增失敗就出現alert框框
                    info_bar
                        // data.error || '新增失敗' 意思是如果有就用data.error的訊息，如果沒有就用"新增失敗的字串"
                        .text(data.error || '修改失敗')
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
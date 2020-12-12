<?php $title = '來！' ?>
<?php include __DIR__ . '/php_parts/config.php' ?>
<?php include __DIR__ . '/php_parts/html.head.php'; ?>
<?php include __DIR__ . '/php_parts/html.nav.php'; ?>



<div class="container">


    <row>
        <div class="col-lg-6">
            <div class="card" ">
                <div class=" card-body">
                <h5 class="card-title">Card title</h5>




                <form>
                    <!-- method如果沒有設定，預設是get -->
                    <!-- 沒有name的欄位就不能送值出去！ -->
                    <!-- 沒有action，代表送出去給自己，或是空字串 -->
                    <pre>
                        <!-- ＄＿ＧＥＴ本身就是一種關聯式陣列，這邊用print_r讓送出後呈現送出的值 -->
                        <?php print_r($_GET) ?>

                    </pre>


                    <div class="form-group">
                        <!-- for 對應到id，不是name -->
                        <!-- 因為label有下for，所以點label的文字，input框也會拿到focus -->
                        <label for="email">Email address</label>
                        <input type="text" class=" form-control" id="email" name="email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>


                    <div class="form-group form-check">
                        <!-- check-box可以給value的值，送出後就會是那個值 -->
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="exampleCheck1" value="是">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>
        </div>



</div>
</row>
</div>

<?php include __DIR__ . '/php_parts/html.script.php'; ?>
<?php include __DIR__ . '/php_parts/html.footer.php'; ?>
<!-- 在這邊設定$title，就可以出現想要的變數 -->
<?php $title = '商品列表' ?>

<!-- 如果有不同層的資料，把css/JS的位置變成絕對路徑 -->
<?php include __DIR__ . '/php_parts/config.php' ?>

<!-- count -->
<?php

$params = []; // 篩選時頁碼
$perPage = 4; // 每頁幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// 拿篩選內的項目，所有商品是0
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0;





// 這邊要建立篩選的側欄，先取到資料庫內分類的資料
$c_sql = "SELECT *FROM categories WHERE parent_sid=0";
$c_rows = $pdo->query($c_sql)->fetchAll();

// 接下來篩選跟商品列表連動
// 先設定一個where變數，裡面的內容是要串SQL的
$where = " WHERE 1 ";
// 如果$cate不是零，代表有被選到的話，where字串要變成什麼
if (!empty($cate)) {
    $params['cate'] = $cate; //如果篩選時有頁碼，頁碼要跟著跳
    $where .= " AND `category_sid`=$cate";
}


// 這邊是要做頁碼
// 這裡加上的$where字串，是讓篩選跟商品連動
$t_sql = "SELECT COUNT(1) FROM products $where";
$t_stmt = $pdo->query($t_sql);

//echo json_encode($t_stmt->fetch(PDO::FETCH_NUM)[0]); exit;
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 總筆數
$totalPages = ceil($totalRows / $perPage); // 總頁數
if ($totalRows != 0) {
    if ($page < 1) {
        header('Location: 37.product-list.php');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: 37.product-list.php?page=' . $totalPages);
        exit;
    }
    // 這裡多挖了product %s，然後後面加上的$where字串，是為了讓篩選跟商品連動
    $sql = sprintf("SELECT * FROM products %s ORDER BY sid DESC LIMIT %s, %s", $where, ($page - 1) * $perPage, $perPage);
    $stmt = $pdo->query($sql);

    $rows = $stmt->fetchAll();
} else {
    $rows = [];
}


?>




<!-- 這裡要引入放在另一個php中的head的資料 -->
<?php
include __DIR__ . '/php_parts/html.head.php';
// require __DIR__ . '/php_parts/html.head.php';
?>

<?php include __DIR__ . '/php_parts/html.script.php'; ?>

<?php include __DIR__ . '/php_parts/html.nav-proj.php'; ?>


<div class="container">
    <!-- <h2>
        <?= json_encode($rows, JSON_UNESCAPED_UNICODE); ?>
    </h2> -->

    <div class="row">
        <!-- 篩選分類 -->
        <div class="col-md-3">
            <div class="btn-group-vertical style="">
                <!-- btn後面是設定，如果現在的是在這裡，框框顏色就反藍 -->
                <!-- 因為ＢＳ自己的設定是 btn-outline-primary代表沒有反藍，這邊就是判斷何時不要反藍 -->
                <a type=" button" class="btn btn<?= empty($cate) ? '' : '-outline' ?>-primary" href="37.product-list.php">所有商品</a>

                <?php foreach ($c_rows as $c) : ?>
                    <a type="button" class="btn btn<?= $cate == $c['sid'] ? '' : '-outline' ?>-primary" href="?cate=<?= $c['sid'] ?>">
                        <?= $c['name'] ?>
                    </a>
                <?php endforeach; ?>
            </div>

        </div>


        <!-- 商品 -->
        <div class="col-md-9">
            <!-- 分頁按鈕 -->
            <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <!-- 前一頁 -->
                            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                <!-- 篩選時頁碼要跟著跳 http_build_query語法 -->
                                <a class="page-link" href="?<?php $params['page'] = $page - 1;
                                                            echo http_build_query($params); ?>">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </a>
                            </li>

                            <!-- 中間頁數 -->
                            <?php for ($i = $page - 2; $i <= $page + 2; $i++) : ?>
                                <?php if ($i >= 1 and $i <= $totalPages) : ?>
                                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                        <a class="page-link" href="?<?php $params['page'] = $i;
                                                                    echo http_build_query($params); ?>">
                                            <?= $i ?></a>
                                    </li>
                                <?php endif ?>
                            <?php endfor ?>

                            <!-- 後一頁 -->
                            <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link" href="?<?php $params['page'] = $page + 1;
                                                            echo http_build_query($params); ?>">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a> </li>
                        </ul>
                    </nav>
                </div>
            </div>



            <!-- 小卡 -->
            <div class="row">
                <!-- 用回圈呈現資料庫撈出的卡片 -->
                <?php foreach ($rows as $r) :  ?>
                    <!-- 顯示商品的sid才能被加入購物車 -->
                    <div class="col-md-3 product-item" data-sid="<?= $r['sid'] ?>">
                        <div class="card">


                            <!-- 產品詳細頁加連結，傳參數過去product-detail01 -->
                            <a href="47.modal-product-detail02.php?sid=<?= $r['sid'] ?>" target="_blank">
                                <!-- 收藏 -->
                                <!-- 清單拿資料時，要順便拿收藏欄位，判斷有無收藏 -->

                                <img src="img/big/<?= $r['book_id'] ?>.png" class="card-img-top" alt="...">
                            </a>


                            
                            <div class="card-body">
                                <!-- 變數抓名稱 -->
                                <h6 class="card-title">

                                    <!--%%%%%% Modal坎入在這邊，用a連結包起來～～～ %%%%%%%%%%%%-->
                                    <a href="javascript: showProductModal(<?= $r['sid'] ?>)">
                                        <?= $r['bookname'] ?>
                                    </a>

                                </h6>
                                <p><i class="fas fa-user-edit"></i><?= $r['author'] ?></p>
                                <p><i class="fas fa-dollar-sign"></i></i><?= $r['price'] ?></p>

                                <!-- 下拉式選單 -->
                                <select class="quantity form-control" style="display: inline-block; width: auto">
                                    <?php for ($i = 1; $i <= 20; $i++) : ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                                <button class="btn btn-primary buy-btn"><i class="fas fa-cart-plus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="row">
        <div class="col">

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- 這邊設定iframe -->
                            <iframe src="47.modal-product-detail02.php?sid=1" frameborder="0" style="width:100%;height:100%;"></iframe>



                        </div>

                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // 先抓到所有的buy-btn，它被點擊時會有觸發什麼功能
    $('.buy-btn').on('click', function() {
        // 先console一次，檢查能不能抓到正確的this，如果不能的話，往上檢查是不是拼錯字
        // console.log(this);


        //btn 被點時，要抓到當個被點的小卡
        //以下抓三個數值，向外層找用 closest; 向內層找用 find
        // 抓到當個商品、他的sid、還有數量
        const item = $(this).closest('.product-item');
        const sid = item.attr('data-sid');
        const qty = item.find('.quantity').val();

        // 檢查
        console.log({
            sid: sid,
            quantity: qty
        });
        // Ajax串起來！！！
        // 四個參數，第一個是發給哪個頁面，第三個是資料回來要做的動作，這邊是直接console
        $.get('44.handle-cart-api.php', {
            sid: sid,
            quantity: qty,
            action: 'add'
        }, function(data) {
            countCart(data.cart);
        }, 'json');
    });


    // modal 秀出
    function showProductModal(sid) {
        // 每次秀之前，先抓當個src的sid
        $('iframe')[0].src = "47.modal-product-detail02.php?sid=" + sid;


        $('#exampleModal').modal('show')
    }
</script>


<?php include __DIR__ . '/php_parts/html.footer.php'; ?>
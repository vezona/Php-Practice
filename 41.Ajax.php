<!-- 在這邊設定$title，就可以出現想要的變數 -->
<?php $title = '商品Ajax' ?>

<!-- 如果有不同層的資料，把css/JS的位置變成絕對路徑 -->
<?php include __DIR__ . '/php_parts/config.php' ?>

<!-- count -->
<?php
// 拿篩選內的項目，所有商品是0
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0;



// 這邊要建立篩選的側欄，先取到資料庫內分類的資料
$c_sql = "SELECT *FROM categories WHERE parent_sid=0";
$c_rows = $pdo->query($c_sql)->fetchAll();

?>

<!-- 這裡要引入放在另一個php中的head的資料 -->
<?php include __DIR__ . '/php_parts/html.head.php'; ?>
<?php include __DIR__ . '/php_parts/html.nav-proj.php'; ?>


<!-- 內容開始 -->
<div class="container">

    <div class="row">
        <!-- 篩選分類 -->
        <div class="col-md-3">

            <!-- JQ寫法抓sid -->
            <div class="btn-group-vertical" style="width: 100%">
                <button type="button" class="cate-btn btn btn-outline-primary" data-sid="0">所有商品</button>
                <?php foreach ($c_rows as $c) : ?>
                    <button type="button" class="cate-btn btn btn-outline-primary" data-sid="<?= $c['sid'] ?>">
                        <?= $c['name'] ?>
                    </button>
                <?php endforeach ?>

                <!-- JS寫法設定event function 抓sid -->
                <!-- <div class="btn-group-vertical" style="width: 100%">
                data-sid="0"是標籤的屬性，用來判斷點了之後拿到的值 -->
                <!-- <button type="button" class="btn btn-outline-primary" data-sid="0" onclick="setCate(event)">所有商品</button> -->
                <!-- <?php foreach ($c_rows as $c) : ?>
                    <button type="button" class="btn btn-outline-primary" data-sid=" <?= $c['sid'] ?>" onclick=" setCate(event)">
                        <?= $c['sid'] ?>
                    </button>
                <?php endforeach; ?> -->

            </div>
        </div>

        <!-- 商品 -->
        <div class=" col-md-9">
            <!-- 小卡 -->
            <div class="row product-list"></div>
        </div>

    </div>
</div>



</div>

<?php include __DIR__ . '/php_parts/html.script.php'; ?>

<script>
    const cate_btns = $('.cate-btn');


    // 前端樣板小卡，先生成一個html的樣板字串格式
    const productTpl = function(a) {
        // 這邊是用樣板字串，樣板字串中盡量不要有php語法，用$去寫變數
        return `<div class="col-md-3">
                <div class="card">
                    <img src="img/big/${a.book_id}.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">${a.bookname}</h6>
                        <p><i class="fas fa-user-edit"></i>${a.author}</p>
                        <p><i class="fas fa-dollar-sign"></i></i>${a.price}</p>
                        <select class="form-control" style="display: inline-block; width: auto">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                        <button class="btn btn-primary"><i class="fas fa-cart-plus"></i></button>
                    </div>
                </div>
            </div>`;
    };



    function whenHashChanged() {
        // slice是不要前面的＃
        // parseInt是要轉換成整數，下面也是，才能抓出來比對，這樣一進去就會是0，所有商品格才會反藍
        let u = parseInt(location.hash.slice(1)) || 0;
        console.log(`a:${u}`);
        getProductData(u);

        // 這邊要改變點選tag時，被點的要反藍
        cate_btns.removeClass('btn-primary').addClass('btn-outline-primary');
        // 一個一個抓出來
        cate_btns.each(function(indes, el) {
            const sid = parseInt($(this).attr('data-sid'));
            if (sid === u) {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary');
            }

        });
    }

    //事件處理器的event type，也就是這邊的’hashchange‘，全部都小寫，不會有大寫的
    window.addEventListener('hashchange', whenHashChanged);
    whenHashChanged();

    // JQ寫法抓sid，這邊要挪到最上面宣告，因為中間改選tag時會用到
    // const cate_btns = $('.cate-btn');
    cate_btns.on('click', function(event) {
        // 這邊要改成根據#改變時反藍，所以要整個挪到上面的function whenHashChanged()裡面
        // cate_btns.removeClass('btn-primary').addClass('btn-outline-primary');
        // $(this).removeClass('btn-outline-primary').addClass('btn-primary');

        const sid = $(this).attr('data-sid') * 1;
        console.log(`sid: ${sid}`);
        location.href = "#" + sid;


        // 


        // 下面是JS的方式設定抓sid
        // function setCate(event) {
        //     // attr拿到的屬性，但拿到的是字串，所以要＊1變成數值
        //     const sid = $(event.target).attr('data-sid') * 1;
        //     console.log(`sid:${sid}`);

    });


    // Ajax語法
    function getProductData(cate = 0) {
        $.get('41.Ajax-api.php', {
            cate: cate
        }, function(data) {
            console.log(data);

            // 呼叫小卡function，它會用回圈設定給出html字串
            let str = '';
            // 這邊的if是為了防止api沒撈到資料，先檢查一下
            if (data.products && data.products.length) {
                data.products.forEach(function(el) {
                    str += productTpl(el);
                });
            }

            // 拿到html字串後，再把所有商品串起來
            $('.product-list').html(str);



        }, 'json');
    }
</script>


<?php include __DIR__ . '/php_parts/html.footer.php'; ?>
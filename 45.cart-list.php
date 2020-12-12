<!-- 在這邊設定$title，就可以出現想要的變數 -->
<?php $title = '' ?>

<!-- 如果有不同層的資料，把css/JS的位置變成絕對路徑 -->
<?php include __DIR__ . '/php_parts/config.php' ?>


<!-- 這裡要引入放在另一個php中的head的資料 -->
<?php
include __DIR__ . '/php_parts/html.head.php';
// require __DIR__ . '/php_parts/html.head.php';
?>

<?php include __DIR__ . '/php_parts/html.script.php'; ?>

<?php include __DIR__ . '/php_parts/html.nav-proj.php'; ?>


<div class="container">
    <!-- 先判斷購物車內有無商品 -->
    <!-- 如果沒有的話，秀出以下文字 -->
    <?php if (empty($_SESSION['cart'])) : ?>
        <div class="alert alert-danger" role="alert">
            購物車內沒有商品
        </div>

        <!-- 如果有的話，就秀出以下表格 -->
    <?php else : ?>
        <div class="row">
            <div class="col">
                <!-- 表格開始 -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">刪除</th>
                            <th scope="col">書名</th>
                            <th scope="col">封面</th>
                            <th scope="col">價格</th>
                            <th scope="col">數量</th>
                            <th scope="col">小計</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 用回圈生出cart內的項目 -->
                        <?php foreach ($_SESSION['cart'] as $i) : ?>
                            <!-- 這邊設定id是要讓下面的removeItem能透過id找到當行tr，然後整筆刪掉 -->
                            <tr class="product-item" data-sid="<?= $i['sid'] ?>" id="prod<?= $i['sid'] ?>">
                                <td><a href="javascript:removeItem(<?= $i['sid'] ?>)">刪除</a></td>
                                <td><?= $i['bookname'] ?></td>
                                <td><img src="img/small/<?= $i['book_id'] ?>.jpg" alt=""></td>

                                <!-- 價格 -->
                                <td class="price" data-price="<?= $i['price'] ?>">
                                    <?= $i['price'] ?>
                                </td>

                                <!-- qty -->
                                <td class="quantity" data-quantity="<?= $i['quantity'] ?>">
                                    <select class="quantity form-control" style="display: inline-block; width: auto">
                                        <?php for ($k = 1; $k <= 20; $k++) : ?>
                                            <option value="<?= $k ?>"><?= $k ?></option>
                                        <?php endfor ?>
                                    </select>
                                </td>


                                <!-- 小計就是用價錢乘上數量 -->
                                <td class="subtotal">0</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>
        </div>



        <!-- 總計 -->
        <div class="row">
            <div class="col">
                <div class="alert alert-primary" role="alert">
                    總計 <span id="totalAmount"></span>
                </div>

            </div>
        </div>

        <!-- 登入登出 -->
        <div class="row">
            <div class="col">
                <?php if (isset($_SESSION['user'])) : ?>
                    <!-- 加上onclick="doBuy() -->
                    <button class="btn btn-success" onclick="doBuy()">結帳</button>
                <?php else : ?>
                    <button class=" btn btn-danger disabled">請先登入會員</button>
                <?php endif; ?>
            </div>
        </div>


    <?php endif; ?>
</div>

<script>
    function removeItem(sid) {
        $.get('44.handle-cart-api.php', {
            sid: sid,
            action: 'remove'
        }, function(data) {
            // nav一樣要算項目數量
            countCart(data.cart);
            // 這邊透過id找到tr，然後整筆刪掉
            $('#prod' + sid).remove();
            // 刪除後，重算總金額
            calcTotal()


        }, 'json');
    }

    // 計算總金額的function
    function calcTotal() {
        let total = 0;
        // 先抓到這個卡片，這邊用each抓出每一個的裡面的東西
        $('.product-item').each(function() {
            const tr = $(this);
            // 就能抓內層價格
            const price = parseInt(tr.find('td.price').attr('data-price'));
            // 再抓內層數量
            const quantity = parseInt(tr.find('td.quantity').attr('data-quantity'));

            // 讓select裡面的數值會變動
            tr.find('td.quantity>select').val(quantity);
            // 再來計算小計
            tr.find('.subtotal').text('$' + price * quantity);
            total += price * quantity;
        });
        $('#totalAmount').text('$' + total);

    }
    // 一進來先計算總金額
    calcTotal();



    // 拿到所有數量下拉區塊
    $('.product-item td.quantity>select').on('change', function() {
        // 要知道哪個項目，數量是多少
        const te = $(this).closest('.product-item');
        const quantity = $(this).val(); //要注意拿到字串還是數字
        const sid = $(this).closest('.product-item').attr('data-sid');
        const combo = $(this); //避免進到下面的callback function時，this會跑掉


        // 現在要發ajx，改變select裡面的數量
        $.get('44.handle-cart-api.php', {
            sid: sid,
            quantity: quantity,
            action: 'add'
        }, function(data) {
            // nav一樣要算項目數量
            countCart(data.cart);
            // 這邊要從select往上找，找到quantity的屬性
            combo.closest('td.quantity').attr('data-quantity', quantity);
            // 換數量後，還要重新計算總金額多少錢，所以要在呼叫一次算總金額的function
            calcTotal();
        }, 'json');


    });


    // onclick="doBuy()

    function doBuy() {
        $.get('52.buy-api.php',
            function(data) {

                if (data.success) {
                    // 這邊成功後是跳alert,但也可以不用， 也可以直接連到其他頁面
                    alert('感謝定購');
                    // reload讓頁面重新載入
                    location.reload();
                } else {
                    // 原則上不應該跑到這邊，這邊只是放來除錯
                    console.log(data);
                }
            }, 'json')

    }
</script>


<?php include __DIR__ . '/php_parts/html.footer.php'; ?>
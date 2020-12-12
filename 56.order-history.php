<?php $title = '訂單明細';

// 如果有不同層的資料，把css/JS的位置變成絕對路徑
include __DIR__ . '/php_parts/config.php';

if (!isset($_SESSION['user'])) {
    header('Location:49.user-login.php');
    exit;
}

// 訂單設定時間
$member_sid = intval($_SESSION['user']['id']);
$o_sql = "SELECT * FROM `orders` WHERE `member_sid`=$member_sid ORDER BY `order_date` DESC";

// 拿到訂單資料
$o_rows = $pdo->query($o_sql)->fetchAll();
// 檢查
// echo json_encode($o_rows);

// 如果沒有訂單的話
if (empty($o_rows)) {
    header('Location:49.user-login.php'); //看要跳到哪個頁面，但其實跳個顯示訊息框比較好
    exit;
}



$order_sids = [];
foreach ($o_rows as $o) {
    // 先拿出訂單id，因為要拿訂單明細
    $order_sids[] = $o['sid'];
}

// 直接抓出訂單明細中，訂單編號是這些值得訂單
// 合併查詢，各種JOIN
$d_sql = sprintf("SELECT d.*, p.bookname, p.book_id FROM `order_details` d 
JOIN `products` p ON p.sid=d.product_sid
WHERE d.`order_sid` IN (%s)", implode(',', $order_sids));

// 拿到的資料一筆一筆叫出來
$d_rows = $pdo->query($d_sql)->fetchAll();

// echo json_encode([
//     'orders' => $o_rows,
//     'details' => $d_rows,

// ]);

// echo $d_sql;
// exit;

// 這裡要引入放在另一個php中的head的資料 

include __DIR__ . '/php_parts/html.head.php';

include __DIR__ . '/php_parts/html.script.php';

include __DIR__ . '/php_parts/html.nav-proj.php'; ?>


<div class="container">
    <div class="row">
        <div class="col">
            <!-- 訂單開始 -->
            <table class="table table-bordered">

                <tbody>
                    <?php foreach ($o_rows as $o) : ?>
                        <tr style="background-color: #a9cfd0;">
                            <td>訂單編號: <?= $o['sid'] ?></td>
                            <td>總金額: <?= $o['amount'] ?></td>
                            <td>訂購時間: <?= $o['order_date'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>商品名</td>
                                            <td>書號</td>
                                            <td>價格</td>
                                            <td>數量</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($d_rows as $d) : ?>
                                            <?php if ($o['sid'] == $d['order_sid']) : ?>
                                                <tr>
                                                    <td><?= $d['product_sid'] ?></td>
                                                    <td><?= $d['bookname'] ?></td>
                                                    <td><?= $d['book_id'] ?></td>
                                                    <td><?= $d['price'] ?></td>
                                                    <td><?= $d['quantity'] ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>




        </div>
    </div>
</div>

<script>
    const dallorCommas = function(n) {
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    };
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>
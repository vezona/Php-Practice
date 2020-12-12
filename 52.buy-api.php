
<?php
require __DIR__ . '/php_parts/config.php';

// 如果沒有登入的話，就跳出錯誤提醒
if (!isset($_SESSION['user'])) {
    echo json_encode([
        'error' => '沒有登入會員'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// 如果購物車已經被清掉了（buy那隻）
if (empty($_SESSION['user'])) {
    echo json_encode([
        'code' => 300,
        'error' => '購物車內沒有內容'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}


// 如果登入的話，要把存在session中的東西拿出來
// 先假設total總金額為0
$total = 0;
foreach ($_SESSION['cart'] as $i) {
    // 算總金額
    $total += $i['price'] * $i['quantity'];
}

// 如果後面要加收件人資料，這邊就要寫入session, 不要直接insert近資料庫
// 把這筆訂單寫進資料庫，要帶入amount的總金額
$o_sql = "INSERT INTO `orders`(`member_sid`, `amount`, `order_date`) VALUES (?, ?, NOW())";
$o_stmt = $pdo->prepare($o_sql);
$o_stmt->execute([
    $_SESSION['user']['id'],
    $total
]);

// 拿到新增的資料的sid
$order_sid = $pdo->lastInsertId();

// 準備要寫進訂單明細的資料庫
$d_sql = "INSERT INTO `order_details`(`order_sid`, `product_sid`, `price`, `quantity`) VALUES (?,?,?,?)";
$d_stmt = $pdo->prepare($d_sql);

foreach ($_SESSION['cart'] as $i) {
    $d_stmt->execute([
        $order_sid,
        $i['sid'],
        $i['price'],
        $i['quantity'],
    ]);
}

// 送出訂單後，就要清除session
unset($_SESSION['cart']);

echo json_encode([
    'success' => true,
], JSON_UNESCAPED_UNICODE);




// 這邊只是為了呈現json格式，讓我們能點開這個檔案先看
// echo json_encode([
//     'new_id' => $pdo->lastInsertId(),
// ], JSON_UNESCAPED_UNICODE);

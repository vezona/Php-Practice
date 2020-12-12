<?php
include __DIR__ . '/php_parts/config.php';

// 儲存，設定購物車session，如果沒設定就給個空陣列
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 如果要回傳
$output = [];

// 購物車會有三個參數
// 1.決定要做什麼動作
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
// 2.要加商品進來時
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
// 3.數量，若沒給數量，預設值是一
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;



// 用switch設定加入購物車不同情況
switch ($action) {
        // 一進來的原始狀態，就是讀取購物車內的內容
    default:
    case 'read':
        break;


        // 第二個action是新增商品的動作
    case 'add':
        // 如果沒有商品也沒有數量的話
        if (!$sid or !$quantity) {
            $output['code'] = 401;
        } else {
            // 如果項目已經存在
            if (isset($_SESSION['cart'][$sid])) {
                // 就只要變更數量就好
                $_SESSION['cart'][$sid]['quantity'] = $quantity;
            } else { //如果項目不存在的話，才去資料庫拉資料，然後抓出來
                // 用產品編號當key
                // 這邊可以選擇要拉哪些資料
                $sql = "SELECT  `sid`,`author`,`bookname`,`price`,`book_id` FROM products WHERE sid=$sid";
                $row = $pdo->query($sql)->fetch();
                if (empty($row)) {
                    $output['code'] = 410;
                } else {
                    // 設定數量，因為產品資料表沒有，只有購物車才有選數量後設定數量
                    $row['quantity'] = $quantity;
                    // 把primary key 當作key，輸入要的資料
                    $_SESSION['cart'][$row['sid']] = $row;
                }
            }
        }
        break;

        // 第三個action是remove移除
        // 移除就要先判斷有沒有在購物車內
    case 'remove':
        // 如果東西有在購物車內的話
        if (isset($_SESSION['cart'][$sid])) {
            unset($_SESSION['cart'][$sid]);
        } else {
            // 如果東西沒有在購物車內的話，就給個提示的420
            $output['code'] = 420;
        }
        break;
}

$output['cart'] = $_SESSION['cart'];
echo json_encode($output, JSON_UNESCAPED_UNICODE);

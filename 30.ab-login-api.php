
<?php
require __DIR__ . '/php_parts/config.php';

// 這邊是決定送出給前端的格式，之後會用ajax送
// 這邊單純登入失敗或成功
$output = [
    'success' => false,
];

// 一般用兩個東西去判斷
// isset 有沒有設定
// empty 是不是空值

// 這邊是判斷帳號是否為空值，如果是的話就跳出
if (empty($_POST['account'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


// 準備sql資料時都用雙引號
$sql = "SELECT `sid`, `account`, `nickname` FROM `admins` WHERE `account`=? AND `password`=SHA1(?)";

//這邊只是準備去檢查$sql的值，如果沒有?可以跳過這邊直接執行，但有問號的話就要去外面拉準備值
$stmt = $pdo->prepare($sql);

// 這裡才是填進值，然後去執行
// 這邊是表單送過來的資料，然後要送到上面$sql中，填入？裡
$stmt->execute([
    $_POST['account'],
    $_POST['password'],
]);

// $row = $stmt->fetch();

// 如果是一的話，代表帳密是正確的
// 就把這筆資料存在ＳＥＳＳＩＯＮ中
if ($stmt->rowCount() > 0) {
    $output['success'] = true;
    // 判斷有找到後，要把值抓出來
    $_SESSION['admin'] = $stmt->fetch();
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);

<?php
require __DIR__ . '/php_parts/config.php';

// 設定登入時才能動作
require __DIR__ . '/php_parts/admin-required.php';

// 這邊是決定送出給前端的格式，之後會用ajax送
$output = [
    'success' => false,
    'code' => 0,
    'error' => '沒有表單資料',

];

// 一般用兩個東西去判斷
// isset 有沒有設定
// empty 是不是空值

// 這邊判斷是，如果送過來的資料沒有名字，就換成json檔然後送出去
if (empty($_POST['name'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 後端也要做檢查資料格式，去確認姓名跟信箱格式
// 重點是後端檢查，如果後端有，前端甚至可以不用
// php的regular expression(preg_)是字串，所以要用引號包起來

// 自己做～～～



// 準備sql資料時都用雙引號
// 這邊要用SQL裡面修改update的語法，然後把值換成?，因為值要從下面表單填寫的資料灌進資料庫
// 這邊是ＳＱＬ裡面更新資料的語法
$sql = "UPDATE `address_book` SET 
        `name`=?,
        `email`=?,
        `mobile`=?,
        `birthday`=?,
        `address`=? WHERE `sid`=?";


//這邊只是準備去檢查$sql的語法是否正確，如果沒有?可以跳過這邊直接執行，但有問號的話就要去下面拉值來新增
$stmt = $pdo->prepare($sql);

// 這邊是表單送過來的資料，然後要用上面的$sql語法，填入？裡後，送進資料庫修改資料庫內的資料
$stmt->execute([
    // 這裡的值都是從表單填入後，post之後的值而來
    $_POST['name'],
    $_POST['email'],
    $_POST['mobile'],
    $_POST['birthday'],
    $_POST['address'],
    $_POST['sid']

]);


// 因為execute語法給出的是布林值，所以要用ture0/false1去設定
// 如果stmt的rowCount等於一(true)，代表有新增成功
if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    $output['error'] = "";
} else {
    $output['error'] = "資料沒有變更";
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);

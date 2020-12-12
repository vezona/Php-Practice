<?php
// 這個檔案做圖片上傳後亂碼改圖片的名稱，以免同樣名稱的圖片會被蓋檔

require __DIR__ . '/php_parts/config.php';

header("Content-Type:Application/json");

$allowFiles = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];


// 判斷這三種
$output = [
    'img' => '',
    'error' => '沒有上傳'
];

// 現在要先決定哪一些檔案可以，這邊是只有限定三種檔
// 如果沒上傳或是檔案格式錯誤
//  myType當作key，如果沒拿到myType,就看成false
if (empty($_FILES['photo'])) {
    // 程式就結束
    $output['ori'] = $_FILES;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

foreach ($_FILES['photo']['type'] as $i => $type) {

    if ($allowFiles[$type]) {
        $newName = uniqid() . rand(100, 999) . $allowFiles[$type];
        move_uploaded_file($_FILES['photo']['tmp_name'][$i], __DIR__ . '/uploads/' . $newName);
        // 會拿到true/flase值
        $output['imgs'][] = $newName;
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

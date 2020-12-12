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
    'error' => '只接受jpeg,png,gif 圖檔'
];

// 現在要先決定哪一些檔案可以，這邊是只有限定三種檔
// 如果沒上傳或是檔案格式錯誤
//  myType當作key，如果沒拿到myType,就看成false
if (empty($_FILES['avatar']) or !$allowFiles[$_FILES['avatar']['type']]) {
    // 程式就結束
    $output['ori'] = $_FILES;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 亂數編號檔名，避免重複檔名蓋檔
$newName = uniqid() . rand(100, 999) . $allowFiles[$_FILES['avatar']['type']];

// 如果順利通過上面的條件，就進行下面的事項
// 從暫存區移動出檔案，（）裡面是從哪裡搬到哪裡
move_uploaded_file($_FILES['avatar']['tmp_name'], __DIR__ . '/uploads/' . $newName);
// 會拿到true/flase值
$output['img'] = WEB_ROOT . 'uploads/' . $newName;
$output['error'] = '';
echo json_encode($output, JSON_UNESCAPED_UNICODE);

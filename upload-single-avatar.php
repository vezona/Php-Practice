<?php
// 這個檔案的bug是，如果有同樣名稱的圖片，就會被蓋檔，類似更新的概念


require __DIR__ . '/php_parts/config.php';

header("Content-Type:Application/json");

$output = [
    'img' => '',
    'error' => '只接受jpeg圖檔'
];

// 現在要先決定哪一些檔案可以，這邊是只有限定jpeg的檔
// 如果沒上傳或是檔案格式錯誤
if (empty($_FILES['avatar']) or $_FILES['avatar']['type'] !== 'image/jpeg') {
    // 程式就結束
    $output['ori'] = $_FILES;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 如果順利通過上面的條件，就進行下面的事項
// 從暫存區移動出檔案，（）裡面是從哪裡搬到哪裡
move_uploaded_file($_FILES['avatar']['tmp_name'], __DIR__ . '/uploads/' . $_FILES['avatar']['name']);
// 會拿到true/flase值
$output['img'] = WEB_ROOT . 'uploads/' . $_FILES['avatar']['name'];
$output['error'] = '';
echo json_encode($output, JSON_UNESCAPED_UNICODE);

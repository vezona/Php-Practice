<?php include __DIR__ . '/php_parts/config.php';


// 如果要排序的話，資料庫要增加sequence
// 設定order by sequence的話，就會按照sequence數值的小到大排列
// visible是如果想把某些欄位藏起來，這邊搜尋1的話，設定為0的資料就不會抓
$sql = "SELECT * FROM categories WHERE visible=1 ORDER BY `sequence`";
$rows = $pdo->query($sql)->fetchAll();
// echo json_encode($rows, JSON_UNESCAPED_UNICODE);


// 樹狀結構
$cate = [];

// 第一層
// 先跑一次回圈，先把裡面所有sid是0的抓出來，當母層
foreach ($rows as $r) {
    if ($r['parent_sid'] == 0) {
        $cate[] = $r;
    }
};

// 再把當作母層的$cate跑一次回圈，判斷有無屬於它的子節點
// 這邊要取cate裡面的key跟值，所以要胖箭頭
foreach ($cate as $k => $c) {
    //這邊的$rows跟上面的不相干，這邊$rows變數設定給
    foreach ($rows as $k2 => $r) {
        // 如果c是r的子結點
        if ($c['sid'] == $r['parent_sid']) {
            // $cate[$k]['children'][] 這一段三個陣列的意思請見下方
            // 透過原本的陣列，後方加上一個children的欄位，然後push進去，進去哪呢？進去到$r
            // 這邊為什麼要透過原本的陣列，是因為foreach是複製選去的，所以不能用$c
            $cate[$k]['children'][] = $r;
        }
    }
};


echo json_encode($cate, JSON_UNESCAPED_UNICODE);

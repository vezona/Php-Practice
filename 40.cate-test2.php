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
?>
<?php include __DIR__ . '/php_parts/html.head.php'; ?>

<!-- 自己的 -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- nav連結 -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>

            <!-- 下拉式選單 -->
            <?php foreach ($cate as $k => $c) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $c['name'] ?>
                    </a>

                    <!-- 下拉式選單的菜單menu -->
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <?php foreach ($c['children'] as $c2) : ?>
                            <a class="dropdown-item" href="#"><?= $c2['name'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>

            <?php endforeach; ?>
        </ul>

    </div>
</nav>


<!-- script -->
<?php include __DIR__ . '/php_parts/html.script.php'; ?>
<?php include __DIR__ . '/php_parts/html.footer.php'; ?>
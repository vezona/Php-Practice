<?php

require __DIR__ . '/php_parts/config.php';
// 這邊設定這個頁面的名稱，這樣切換到這個頁面的時候，navbar檔裡面，頁面li連結的時候，active才能作用
$pageName = 'ab-list';

//設定每頁最多五筆資料,然後要算總共有幾頁
$perPage = 5;
//下面是設定使用者看到底幾頁，如果有第幾頁就顯示，如果沒有就到第一頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;


// 要算頁數要先知道目前的資料總共有幾筆
$t_sql = "SELECT COUNT(1) FROM address_book";
// 一筆一筆抓出來
$t_stml = $pdo->query($t_sql);

//這邊是可以用json格式檢查總共多少筆資料
// echo json_encode($t_stml->fetch());
// 讓php的程式停下來
// exit;


//fetch(PDO::FETCH_NUM)[0]只是可以讓fetch顯示索引是陣列，然後是第0個陣列，這樣出來就只會有數值，不會有一大堆關聯是陣列的東西
$totalRows = $t_stml->fetch(PDO::FETCH_NUM)[0]; //抓出總筆數


//接下來要去計算總頁數，總比數除每頁筆數就是總頁數。ceil是取無條件進位的最大整數，floor小數點後全捨棄
$totalPages = ceil($totalRows / $perPage);


// $stmt指的是代理的物件，我們不是直接存取，而是用一個代理的物件存取資料庫
// 這邊的pdo就是config裡面設定的變數
// 這邊query後面就是加資料表名稱，表示你要存取哪個資料表
// $stmt = $pdo->query("SELECT*FROM address_book ORDER BY sid DESC");

//設定條件
// if($totalRows!=0) 意思是至少要有資料，筆數不是0的話，才執行以下的各種條件
//避免陷入頁面0的無窮迴圈
if ($totalRows != 0) {

    // 這邊是設定如果頁面小於1的話，設定檔頭，讓它跳轉回原始第一頁
    if ($page < 1) {
        header('Location: 22.ab-list.php');
        exit;
    }

    // 這邊是設定如果頁面大於我有的所有頁面的話，設定檔頭，讓它跳轉到最後一頁
    if ($page > $totalPages) {
        header('Location: 22.ab-list.php?page=' . $totalPages);
        exit;
    }

    //這邊是設定使用者在第幾頁就顯示第幾頁的資料，所以上面的就註解掉。上面是呈現所有的資料
    // LIMIT 0,5 這個語法後面有兩個數值，意思是從第0筆開始，取出5筆（後面的數值是要取幾筆）

    $sql = sprintf("SELECT*FROM address_book ORDER BY sid DESC LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
    $stmt = $pdo->query($sql);
    // 可以把這個代理的資料庫一筆一筆存出來，但一樣要設定一個變數
    // $row = $stmt->fetch(); //取得一筆

    // fetchAll 拿到所有內容
    $rows = $stmt->fetchALL();
    //也可以在這邊改成fetch_both，把關連式資料庫跟一般資料庫的資料呈現方式都用
    // $row = $stmt->fetch(PDO::FETCH_BOTH);


} else {
    $rows = [];
}




// 輸出資料庫
// php拿出來就是一個關聯是陣列，在config裡面的檔案fetch設定
// JSON_UNESCAPED_UNICODE 這一列是中文時不要跳脫字元
// echo json_encode($row, JSON_UNESCAPED_UNICODE);


// 這邊是講用回圈一筆一筆取出全部資料的方式
// $data = [];
//while回圈是條件是，如果ture就會執行裡面的東西，如果flase就會跳開
// while ($row = $stmt->fetch()) {
//     $data[] = $row;
// }

//這邊是告訴客戶端我送的資料是json檔，不然預設會用html傳，這樣的話萬一資料內有<script>之類的語法，會影響到資料呈現
// header('Content-Type:application/json');
// echo json_encode($data, JSON_UNESCAPED_UNICODE);


?>


<!-- 這裡開始就是html -->
<?php include __DIR__ . '/php_parts/html.head.php'; ?>
<?php include __DIR__ . '/php_parts/html.nav.php'; ?>

<div class="container mt-3">
    <!-- 頁籤欄位 -->
    <div class="row">
        <div class="col">

            <!-- 頁籤 -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- 這邊是設定如果到了第一頁的話，這個按鈕就不能繼續按了 -->
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?> ">
                        <!-- 這邊是設定每按一次，頁面就會-1 -->
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fas fa-arrow-circle-left"></i>
                        </a>


                    </li>

                    <!-- 這邊用for回圈一一列出所有頁面的頁碼 -->
                    <!-- for ($i = 1; $i < $totalPages; $i++) : -->
                    <?php for ($i = $page - 2; $i <= $page + 2; $i++) : ?>
                        <?php if ($i >= 1 and $i <= $totalPages) : ?>
                            <!-- 如果我回圈裡面的值等於page的值，才加上active -->
                            <!-- 這樣點選在哪一頁，才會是那頁active -->
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">

                                <!-- 這邊是在<a> 中間下頁面的變數</a>，然後再最外層的回圈呈現當前頁面的頁碼 -->
                                <!-- 然後再<a  標籤裡面的 href設定變數，呈現當前所在i的頁面> -->
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endif ?>
                    <?php endfor ?>


                    <!-- 這邊是設定如果到了最後一頁，這個按鈕就不能繼續按了 -->
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?> ">
                        <!-- 這邊是設定每按一次，頁面就會＋1 -->
                        <a class=" page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>

                    </li>
                </ul>
            </nav>


        </div>
    </div>




    <!--  -->
    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped table-bordered mt-1">
                <thead>
                    <tr>
                        <!-- 加個刪除 -->
                        <th scope="col">
                            <i class="fas fa-trash"></i>
                        </th>

                        <!-- 中間資料庫主體 -->
                        <th scope="col">sid</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">mobile</th>
                        <th scope="col">birthday</th>
                        <th scope="col">address</th>

                        <!-- 加個編輯 -->
                        <th scope="col">
                            <i class="fas fa-edit"></i>
                        </th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($rows as $r) : ?>

                        <tr>
                            <!-- 加個刪除按鈕，要用a包起來才能點 -->
                            <td>
                                <!-- 加個提醒框 delete_it，而不要直接連到刪除頁面 -->
                                <!-- <a href="ab-del.php?sid=<?= $r['sid'] ?>"> -->
                                <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>

                            <!-- 資料庫主體 -->
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <!--  htmlentities 是避免填入的資料內含html標籤，它會把html標籤都記載成純文字 -->
                            <td><?= htmlentities($r['address']) ?></td>
                            <!--  strip_tags 是把html標籤丟掉 -->
                            <!-- <td><?= strip_tags($r['address']) ?></td> -->

                            <!-- 加個編輯按鈕，要用a包起來才能點  -->
                            <td>
                                <a href="26.ab-edit.php?sid=<?= $r['sid'] ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>

                            <!-- onclick會呼叫一個function -->
                            <!-- a 標籤跟button呼叫function的方式 -->
                            <!-- <button onclick="f()"></button> -->
                            <!-- <a href="javascript:f()"></a> -->


                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>


</div>


<?php include __DIR__ . '/php_parts/html.script.php'; ?>

<script>
    function delete_it(sid) {
        // confirm 方法，按確定就是true, 取消就是flase
        if (confirm(`確定要刪除編號為${sid}的資料嗎？`)) {
            // 如果按確定的話，要回到原本的頁面
            location.href = "25.ab-del.php?sid=" + sid;
        }
    }
</script>
<?php include __DIR__ . '/php_parts/html.footer.php'; ?>
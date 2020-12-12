<?php
// 如果沒有設定pageName的話，就呈現空字串
if (!isset($pageName)) {
    $pageName = '';
}
?>


<style>
    .navbar .nav-item.active {
        border: blue 2px solid;
        border-radius: 10px;

    }
</style>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- 設定如果是這個路徑的話，就顯示active -->
                <li class="nav-item <?= $pageName === 'ab-list' ? 'active' : '' ?>">
                    <a class="nav-link" href="22.ab-list.php">通訊錄列表</a>
                </li>

                <!-- 設定如果是這個路徑的話，就顯示active -->
                <li class="nav-item <?= $pageName === 'ab-insert' ? 'active' : '' ?>"">
                    <a class=" nav-link" href="23.ab-insert.php">新增通訊資料</a>
                </li>

                <!-- login page -->
                <!-- 這邊是指如果沒有Session的admin值=沒有登入，nav就出現下面這個文字 -->
                <?php if (!isset($_SESSION['admin'])) : ?>
                    <li class="nav-item <?= $pageName === 'ab-login' ? 'active' : '' ?>">
                        <a class="nav-link" href="29.ab-login.php">管理通訊錄-登入</a>
                    </li>
                <?php else : ?>
                    <!-- *********沒寫成功！！要改 -->
                    <!-- login page 這邊要讓上面的navbar顯示登入後的名字 -->
                    <li class="nav-item">
                        <a class="nav-link"><?= $_SESSION['admin']['nickname'] ?></a>
                    </li>

                    <!-- 登出 -->
                    <li class="nav-item">
                        <a class="nav-link" href="31.ab-logout-api.php">登出</a>
                    </li>
                <?php endif ?>
            </ul>


        </div>
    </div>
</nav>
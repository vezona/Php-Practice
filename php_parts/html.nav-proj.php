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
                    <a class="nav-link" href="37.product-list.php">商品列表</a>
                </li>

                <!-- 設定如果是這個路徑的話，就顯示active -->
                <li class="nav-item <?= $pageName === 'ab-insert' ? 'active' : '' ?>"">
                    <a class=" nav-link" href="45.cart-list.php">購物車
                    <!-- 購物車數量小提示 -->
                    <span class="badge badge-pill badge-info count-badge">0</span>
                    </a>
                </li>

                <!-- ajax -->
                <li class="nav-item <?= $pageName === 'product-list-ajax' ? 'active' : '' ?>">
                    <a class="nav-link" href="41.Ajax.php">商品列表Ajax</a>
                </li>


            </ul>

            <!-- second Ul -->
            <ul class="navbar-nav ">
                <!-- 這邊是設定如果有登入的話，要顯示什麼 -->
                <?php if (isset($_SESSION['user'])) : ?>
                    <!-- 設定如果是這個路徑的話，就顯示active -->
                    <!-- <li class="nav-item">
                        <a class=" nav-link" href="49.user-login.php"> -->
                    <!-- 顯示用戶名稱 -->
                    <!-- <= $_SESSION['user']['nickname'] ?>
                    </a>
                    </li> -->

                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $_SESSION['user']['nickname'] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">修改會員密碼</a>
                            <a class="dropdown-item" href="#">修改</a>
                            <a class="dropdown-item" href="56.order-history.php">歷史訂單</a>
                        </div>
                    </li>


                    <!-- 設定如果是這個路徑的話，就顯示active -->
                    <li class="nav-item <?= $pageName === 'ab-insert' ? 'active' : '' ?>">
                        <a class=" nav-link" href="51.user-logout-api.php">登出</a>
                    </li>

                    <!-- 這邊是設定如果沒有登入的話，要顯示什麼 -->
                <?php else : ?>
                    <!-- 設定如果是這個路徑的話，就顯示active -->
                    <li class="nav-item <?= $pageName === 'ab-list' ? 'active' : '' ?>">
                        <a class="nav-link" href="49.user-login.php">登入</a>
                    </li>

                    <!-- 設定如果是這個路徑的話，就顯示active -->
                    <li class="nav-item <?= $pageName === 'ab-insert' ? 'active' : '' ?>">
                        <a class=" nav-link" href="">註冊</a>
                    </li>
                <?php endif; ?>



            </ul>
        </div>
    </div>
</nav>


<!-- 購物車數量變動 -->
<script>
    const count_badge = $('.count-badge');

    function countCart(cart) {
        let count = 0;
        for (let i in cart) {
            count += cart[i].quantity * 1;
        }
        count_badge.html(count);
    }

    $.get('44.handle-cart-api.php', function(data) {
        console.log(data);
        countCart(data.cart);
    }, 'json');
</script>
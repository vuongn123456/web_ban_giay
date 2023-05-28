<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Miễn phí vận chuyển, bảo đảm đổi trả hoặc hoàn tiền trong 30 ngày.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <a href="#">Đăng nhập</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="index.php"><img src="assets/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class=""><a href="index.php">Trang chủ</a></li>
                        <li><a href="index.php?controller=product&action=showAll&page=1">Sản phẩm</a></li>
                        <li><a href="./blog.html">Tin tức</a></li>
                        <li><a href="./contact.html">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src="assets/img/icon/search.png" alt=""></a>
                    <a href="#"><img src="assets/img/icon/heart.png" alt=""></a>

                    <a href="index.php?controller=cart&action=index" ><img src="assets/img/icon/cart.png" alt="" >
                        <?php
                        $cart_total = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] AS $cart) {
                                $cart_total += $cart['quantity'];
                            }
                        }
                        ?>
                        <span class="cart-amount">
                            <?php echo $cart_total; ?>
                        </span>
                    </a>
                </div>
            </div>
            <span class="ajax-message"></span>
        </div>
    </div>
</header>

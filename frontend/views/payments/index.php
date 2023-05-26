<?php
require_once 'helpers/Helper.php';
?>

<section class="breadcrumb-option mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Chi tiết thanh toán</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="" method="POST">
                <?php
                //biến lưu tổng giá trị đơn hàng
                $total = 0;
                if (isset($_SESSION['cart'])):
                ?>
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Thông tin khách hàng</h6>
                        <div class="checkout__input">
                            <p>Họ tên<span> *</span></p>
                            <input type="text" name="fullname" value="" class="form-control" placeholder="Họ tên">
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span> *</span></p>
                            <input type="text" name="address" value="" class="form-control" placeholder="Địa chỉ">
                        </div>
                        <div class="checkout__input">
                            <p>Số điện thoại<span> *</span></p>
                            <input type="number" min="0" name="mobile" value="" class="form-control" placeholder="Số điện thoại">
                        </div>
                        <div class="checkout__input">
                            <p>Email<span> *</span></p>
                            <input type="email" min="0" name="email" value="" class="form-control" placeholder="Email">
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú </p>
                            <textarea name="note" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Đơn hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Giá</span></div>
                            <ul class="checkout__total__products">
                                <?php foreach ($_SESSION['cart'] AS $product_id => $cart):
                                ?>
                                    <?php
                                    $price_total = $cart['price'] * $cart['quantity'];
                                    $total += $price_total;
                                    ?>

                                <li><?php echo $cart['name']; ?>&emsp;&emsp;x&emsp;&emsp;<?php echo $cart['quantity']; ?> <span><?php echo number_format($cart['price'], 0, '.', '.') ?> <sup>đ</sup></span></li>

                                <?php endforeach; ?>
                            </ul>

                            <ul class="checkout__total__all">

                                <li>Tổng cộng <span><?php echo number_format($total, 0, '.', '.') ?> <sup>đ</sup></span></li>

                            </ul>
                            <div class="checkout__input__checkbox mb-3">
                                    <label>Chọn phương thức thanh toán</label> <br />
                                    <input type="radio" name="method" value="0" /> Thanh toán trực tuyến <br />
                                    <input type="radio" name="method" checked value="1" /> COD (dựa vào địa chỉ của bạn) <br />
                            </div>
                            <input type="submit" name="submit" value="Thanh toán" class="site-btn">
                            <a href="gio-hang-cua-ban.html" class="site-btn" style="text-align: center">Về trang giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </form method="POST">
        </div>
    </div>
</section>


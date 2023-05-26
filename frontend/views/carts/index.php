
<section class="breadcrumb-option mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Giỏ hàng của bạn</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php if (isset($_SESSION['cart'])) : ?>
                <div class="shopping__cart__table">
                    <form action="" method="post">
                        <table>
                            <thead>

                                <tr>
                                    <th width="40%">Sản phẩm</th>
                                    <th width="12%">Số lượng</th>
                                    <th style="text-align: center">Giá</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>

                                <?php
                                $total_price = 0;
                                foreach ($_SESSION['cart'] AS $product_id => $product):
                                ?>

                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="../backend/assets/uploads/<?php echo $product['avatar'] ?>" alt="" width="80">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6><?php echo $product['name'] ?></h6>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <!--                      cần khéo léo đặt name cho input số lượng, để khi xử lý submit form update lại giỏ hànTin nổi bậtg sẽ đơn giản hơn    -->
                                        <input type="number" min="0" name="<?php echo $product_id?>" class="product-amount form-control"
                                               value="<?php echo $product['quantity'] ?>">
                                    </td>
                                    <td class="cart__price" style="text-align: center"><?php echo number_format($product['price']); ?><sup>đ</sup></td>
                                    <td class="cart__price">
                                        <?php
                                        $product_price = $product['price'] * $product['quantity'];
                                        $total_price += $product_price;
                                        echo number_format($product_price);
                                        ?>
                                        <sup>đ</sup>
                                    </td>
                                    <td class="cart__close close__hover">
                                        <a href="index.php?controller=cart&action=delete&id=<?php echo $product_id; ?>">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>


                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                        <div class="row mt-5">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="index.php?controller=payment&action=index">Đến trang thanh toán</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn update__btn">
                                    <input type="submit" name="submit" value="Cập nhật giá" class="btn btn-dark">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php else: ?>
                    <h3>Giỏ hàng trống</h3>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Tổng giỏ hàng</h6>
                    <ul>
                        <li>Tổng cộng <span><?php echo number_format($total_price); ?><sup>đ</sup></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
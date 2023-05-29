<section class="shop-details">
    <?php if (!empty($product)): ?>
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 col-md-9 ">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="../backend/assets/uploads/<?php echo $product['avatar'] ?>" alt="" style="max-width: 35%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4> <?php echo $product['title']; ?></h4>
                        <h3><?php echo number_format($product['price'], 0, '.', ','); ?><sup>₫</sup> </h3>
                        <div class="product__details__cart__option">
                            <a href="index.php?controller=cart&action=add&id=<?= $product['id'] ?>" class="primary-btn add-cart" data-id="<?php echo $product['id']?>">Thêm vào giỏ</a>
                        </div>
                        <div class="product__details__btns__option">
                        </div>
                        <div class="product__details__last__option">
                            <h5><span>Áp dụng các hình thức thanh toán</span></h5>
                            <img src="assets/img/shop-details/details-payment.png" alt="">
                            <ul>
                                <li><span>Danh mục : </span> <?php echo $product['category_name']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô tả</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">

                                    <div class="product__details__tab__content__item">
                                        <?php echo $product['content']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
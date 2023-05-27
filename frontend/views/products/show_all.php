<!--Chức nwang filter do kết hợp với rewrite url nên ko dùng phương thức GET cho form, vì xử lý rewrite sẽ rất phức tạp
thay vào đó sẽ dùng POST
-->
<?php
require_once 'helpers/Helper.php';
?>

<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <form action="" method="post">
                    <div class="shop__sidebar">
                            <div class="shop__sidebar__accordion">
                                <div class="accordion" id="accordionExample">

                                    <?php if (!empty($categories)): ?>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__categories">
                                                    <?php foreach ($categories AS $category):
                                                    //đổ lại dữ liệu đã check category
                                                    $category_checked = '';
                                                    if (isset($_POST['category'])) {
                                                        if (in_array($category['id'], $_POST['category'])) {
                                                            $category_checked = 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    <input type="checkbox" name="category[]"
                                                           value="<?php echo $category['id']; ?>" <?php echo $category_checked; ?>  /> <?php echo $category['name']; ?>
                                                        <br>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>


                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseThree">Khoảng giá</a>
                                        </div>
                                        <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__price">

                                                    <?php
                                                    //cần đổ lại dữ liệu ra form search
                                                    $price1_checked = '';
                                                    $price2_checked = '';
                                                    $price3_checked = '';
                                                    $price4_checked = '';
                                                    if (isset($_POST['price'])) {
                                                        foreach ($_POST['price'] as $price) {
                                                            if ($price == 1) {
                                                                $price1_checked = 'checked';
                                                            }
                                                            if ($price == 2) {
                                                                $price2_checked = 'checked';
                                                            }
                                                            if ($price == 3) {
                                                                $price3_checked = 'checked';
                                                            }
                                                            if ($price == 4) {
                                                                $price4_checked = 'checked';
                                                            }
                                                        }
                                                    }
                                                    ?>


                                                    <input type="checkbox" name="price[]" value="1" <?php echo $price1_checked; ?> /> Dưới 1tr <br/>
                                                    <input type="checkbox" name="price[]" value="2" <?php echo $price2_checked; ?> /> Từ 1 - 2tr
                                                    <br/>
                                                    <input type="checkbox" name="price[]" value="3" <?php echo $price3_checked; ?> /> Từ 2 - 3tr
                                                    <br/>
                                                    <input type="checkbox" name="price[]" value="4" <?php echo $price4_checked; ?> /> Trên 3tr
                                                    <br/>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="form-group">
                                            <input type="submit" name="filter" value="Filter" class="primary-btn" style="border: none"/>
                                            <a href="index.php?controller=product&action=showAll" class="btn btn-default">Xóa filter</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
                </div>
            <div class="col-lg-9">
                <?php if (!empty($products)): ?>
                <div class="row">
                    <?php
                        foreach ($products AS $product):
//                            $slug = Helper::getSlug($product['title']);
//                            $product_link = "san-pham/$slug/" . $product['id'] . ".html";
//                            $product_cart_add = "them-vao-gio-hang/" . $product['id'] . ".html";
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="../backend/assets/uploads/<?php echo $product['avatar'] ?>" width="260">
                                            <ul class="product__hover">
                                                <li><a href="#"><img src="assets/img/icon/heart.png" alt=""></a></li>
                                                <li><a href="#"><img src="assets/img/icon/compare.png" alt=""> <span>Compare</span></a>
                                                </li>
                                                <li><a href="index.php?controller=product&action=detail&id=<?= $product['id'] ?>"><img src="assets/img/icon/search.png"><span>Chi tiết</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><?= $product['title'] ?></h6>
                                            <a href="index.php?controller=cart&action=add&id=<?= $product['id'] ?>" class="add-cart" data-id="<?php echo $product['id'] ?>">+ Thêm vào giỏ</a>

                                            <h5><?php echo number_format($product['price']) ?><sup>đ</sup></h5>
                                        </div>
                                    </div>
                            </div>
                    <?php
                        endforeach;
                    ?>

                </div>

                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <?php $pages = ceil($count_product / 9) ;
                                for ($i = 1 ; $i <= $pages ; $i++){
                            ?>
                                <a class="<?php if($_GET['pages'] == $i){
                                    echo 'active';
                                }else {
                                    echo '';
                                } ?>" href="index.php?controller=product&action=showAll&pages=<?php echo $i?>"><?php echo $i?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


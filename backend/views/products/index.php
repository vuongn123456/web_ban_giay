<?php
require_once 'helpers/Helper.php';
?>

<h2>Danh sách sản phẩm</h2>
    <a href="index.php?controller=product&action=create" class="btn btn-success">
        <i class="fa fa-plus"></i> Thêm mới
    </a>
<br>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Tên thương hiệu</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Size</th>
            <th>Số lượng</th>
            <th>Mô tả ngắn sản phẩm</th>
            <th>Mô tả chi tiết sản phầm</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id'] ?></td>
                <td><?php echo $product['category_name'] ?></td>
                <td><?php echo $product['title'] ?></td>
                <td>
                    <?php if (!empty($product['avatar'])): ?>
                        <img height="80" src="assets/uploads/<?php echo $product['avatar'] ?>"/>
                    <?php endif; ?>
                </td>
                <td><?php echo number_format($product['price']) ?></td>
                <td><?php echo $product['amount'] ?></td>
                <td><?php echo Helper::getStatusText($product['status']) ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($product['created_at'])) ?></td>
                <td><?php echo !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '--' ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=product&action=detail&id=" . $product['id'];
                    $url_update = "index.php?controller=product&action=update&id=" . $product['id'];
                    $url_delete = "index.php?controller=product&action=delete&id=" . $product['id'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                                class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="9">No data found</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
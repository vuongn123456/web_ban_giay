<h2>Danh sách sản phẩm</h2>
    <a href="index.php?controller=product&action=create" class="btn btn-success">
        <i class="fa fa-plus"></i> Thêm mới
    </a>
<br>
<br>
<table class="tablee table-bordered table-responsive">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
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
        <?php foreach ($products as $product): ?>
            <tr>
                <td>
                    <?php echo $product['id'] ?>
                </td>
                <td>
                    <?php echo $product['category_name'] ?>
                </td>
                <td>
                    <?php echo $product['title'] ?>
                </td>
                <td>
                    <?php if (!empty($product['avatar'])): ?>
                        <img height="80" src="assets/uploads/<?php echo $product['avatar'] ?>"/>
                    <?php endif; ?>
                </td>
                <td><?php echo number_format($product['price']) ?></td>
                <td><?php echo $product['amount'] ?></td>
                <td><?php echo $product['summary'] ?></td>
                <td><?php echo $product['content'] ?></td>
                <td>
                    <?php
                    $status_text = '<span class="status__active">Active</span>';
                    if ($product['status'] == 0) {
                        $status_text = '<span class="status__disabled">Disabled</span>';
                    }
                    echo $status_text;
                    ?>

                </td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($product['created_at'])) ?></td>

                <td><?php echo !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '--' ?></td>
                <td>
                    <a title="Chi tiết" href="index.php?controller=product&action=detail&id=<?php echo $product['id'] ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Update" href="index.php?controller=product&action=update&id=<?php echo $product['id'] ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="index.php?controller=product&action=delete&id=<?php echo $product['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')"><i
                                class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<h1>Quản lý thương hiệu</h1>
<a href="index.php?controller=brand&action=create" class="btn btn-primary">
    <i class="fa fa-plus"> Thêm mới</i>
</a>
<br/>
<br/>
    <table class="tablee table-bordered table-responsivez " >
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($brands as $brand): ?>
            <tr>
                <td>
                    <?php echo $brand['id']; ?>
                </td>
                <td>
                    <?php echo $brand['name']; ?>
                </td>
                <td>
                    <?php if (!empty($brand['avatar'])): ?>
                        <img src="assets/uploads/<?php echo $brand['avatar'] ?>" width="60"/>
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo $brand['description']; ?>
                </td>
                <td>
                    <?php
                    $status_text = '<span class="status__active">Active</span>';
                    if ($brand['status'] == 0) {
                        $status_text = '<span class="status__disabled">Disabled</span>';
                    }
                    echo $status_text;
                    ?>

                </td>
                <td>
                    <?php echo date('d-m-Y H:i:s', strtotime($brand['created_at'])); ?>
                </td>
                <td>
                    <?php
                    if (!empty($brand['updated_at'])) {
                        echo date('d-m-Y H:i:s', strtotime($brand['updated_at']));
                    }
                    ?>
                </td>
                <td>
                    <a href="index.php?controller=brand&action=detail&id=<?php echo $brand['id'] ?>"
                       title="Chi tiết" >
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="index.php?controller=brand&action=update&id=<?php echo $brand['id'] ?>" title="Sửa">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    <a href="index.php?controller=brand&action=delete&id=<?php echo $brand['id'] ?>" title="Xóa"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<!--  hiển thị phân trang-->


<h1>Quản lý danh mục</h1>
<a href="index.php?controller=category&action=create" class="btn btn-primary">
    <i class="fa fa-plus"> Thêm mới</i>
</a>
<br/>
<br/>
    <table class="tablee table-bordered table-responsive " >
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
        <?php foreach ($categories as $category): ?>
            <tr>
                <td>
                    <?php echo $category['id']; ?>
                </td>
                <td>
                    <?php echo $category['name']; ?>
                </td>
                <td>
                    <?php if (!empty($category['avatar'])): ?>
                        <img src="assets/uploads/<?php echo $category['avatar'] ?>" width="60"/>
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo $category['description']; ?>
                </td>
                <td>
                    <?php
                    $status_text = '<span class="status__active">Active</span>';
                    if ($category['status'] == 0) {
                        $status_text = '<span class="status__disabled">Disabled</span>';
                    }
                    echo $status_text;
                    ?>

                </td>
                <td>
                    <?php echo date('d-m-Y H:i:s', strtotime($category['created_at'])); ?>
                </td>
                <td>
                    <?php
                    if (!empty($category['updated_at'])) {
                        echo date('d-m-Y H:i:s', strtotime($category['updated_at']));
                    }
                    ?>
                </td>
                <td>
                    <a href="index.php?controller=category&action=detail&id=<?php echo $category['id'] ?>"
                       title="Chi tiết" >
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="index.php?controller=category&action=update&id=<?php echo $category['id'] ?>" title="Sửa">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    <a href="index.php?controller=category&action=delete&id=<?php echo $category['id'] ?>" title="Xóa"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<!--  hiển thị phân trang-->


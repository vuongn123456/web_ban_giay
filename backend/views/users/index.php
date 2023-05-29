<h1>Quản lý users</h1>
<br/>
<br/>
    <table class="tablee table-bordered table-responsive " >
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Quyền</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?php echo $user['id']; ?>
                </td>
                <td>
                    <?php echo $user['username']; ?>
                </td>
                <td>
                    <?php
                    if ($user['status'] == 1) {
                        echo "Quản trị viên";
                    }
                    ?>

                </td>
                <td>
                    <?php echo date('d-m-Y H:i:s', strtotime($user['created_at'])); ?>
                </td>
                <td>
                    <?php
                    if (!empty($user['updated_at'])) {
                        echo date('d-m-Y H:i:s', strtotime($user['updated_at']));
                    }
                    ?>
                </td>
                <td>
                    <a href="index.php?controller=user&action=detail&id=<?php echo $user['id'] ?>"
                       title="Chi tiết" >
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="index.php?controller=user&action=update&id=<?php echo $user['id'] ?>" title="Sửa">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    <a href="index.php?controller=user&action=delete&id=<?php echo $user['id'] ?>" title="Xóa"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<!--  hiển thị phân trang-->


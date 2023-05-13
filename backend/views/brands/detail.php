<h1>Chi tiết thương hiệu</h1>

<table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?php echo $brand['id']; ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo $brand['name']; ?></td>
        </tr>
        <tr>
            <th>Avatar</th>
            <td>
                <?php if (!empty($brand['avatar'])): ?>
                    <img src="assets/uploads/<?php echo $brand['avatar'] ?>" width="60"/>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?php echo $brand['description']; ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <?php
                $status_text = 'Active';
                if ($brand['status'] == 0) {
                    $status_text = 'Disabled';
                }
                echo $status_text;
                ?>
            </td>
        </tr>
        <tr>
            <th>Created_at</th>
            <td>
                <?php echo date('d-m-Y H:i:s', strtotime($brand['created_at'])); ?>
            </td>
        </tr>
        <tr>
            <th>Updated_at</th>
            <td>
                <?php echo date('d-m-Y H:i:s', strtotime($brand['updated_at'])); ?>
            </td>
        </tr>
</table>
<a class="btn btn-primary" href="index.php?controller=category">Back</a>


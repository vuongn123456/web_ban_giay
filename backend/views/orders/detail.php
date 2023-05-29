<h1>Chi tiết đơn hàng</h1>
<br/>
<br/>
<table class="tablee table-bordered table-responsive " >
    <thead>
    <tr>
        <th>Tên khách hàng</th>
        <th>Địa chỉ</th>
        <th>Số điện thoại</th>
        <th>Email</th>
        <th>Ghi chú</th>
        <th>Tồng giá trị đơn hàng</th>
        <th>Tên sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Số lượng sản phẩm</th>
        <th>Thành tiền</th>
        <th>Hình thức thanh toán</th>
        <th>Ngày tạo</th>
        <th>Ngày cập nhật</th>
        <th>Chức năng</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td>
                <?php echo $order['fullname']; ?>
            </td>
            <td>
                <?php echo $order['address']; ?>
            </td>
            <td>
                <?php echo $order['mobile']; ?>
            </td>
            <td>
                <?php echo $order['email']; ?>
            </td>
            <td>
                <?php echo $order['note']; ?>
            </td>
            <td>
                <?php echo number_format($order['price_total']); ?><sup>đ</sup>
            </td>
            <td>
                <?php echo $order['product_name']; ?>
            </td>
            <td>
                <?php echo number_format($order['product_price']); ?><sup>đ</sup>
            </td>
            <td>
                <?php echo $order['quantity']; ?>
            </td>
            <td>
                <?php echo number_format($order['product_price'] * $order['quantity']); ?><sup>đ</sup>
            </td>
            <td>
                <?php
                $status_text = '<span class="status__disabled">Payment</span>';
                if ($order['payment_status'] == 0) {
                    $status_text = '<span class="status__active">Ship COD</span>';
                }
                echo $status_text;
                ?>

            </td>
            <td>
                <?php echo date('d-m-Y H:i:s', strtotime($order['created_at'])); ?>
            </td>
            <td>
                <?php
                if (!empty($order['updated_at'])) {
                    echo date('d-m-Y H:i:s', strtotime($order['updated_at']));
                }
                ?>
            </td>
            <td>
                <a href="index.php?controller=order&action=detail&id=<?php echo $order['id'] ?>"
                   title="Chi tiết" >
                    <i class="fa fa-eye"></i>
                </a>
                <a href="index.php?controller=order&action=update&id=<?php echo $order['id'] ?>" title="Sửa">
                    <i class="fa fa-pencil-alt"></i>
                </a>
                <a href="index.php?controller=order&action=delete&id=<?php echo $order['id'] ?>" title="Xóa"
                   onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<!--  hiển thị phân trang-->


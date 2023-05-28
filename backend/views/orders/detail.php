<h1>Chi tiết đơn hàng</h1>

<table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?php echo $order['id']; ?></td>
        </tr>
        <tr>
            <th>Tên khách hàng</th>
            <td><?php echo $order['fullname']; ?></td>
        </tr>
        <tr>
            <th>Địa chỉ</th>
            <td>
                <?php echo $order['address']; ?>
            </td>
        </tr>
    <tr>
        <th>Số điện thoại</th>
        <td>
            <?php echo $order['mobile']; ?>
        </td>
    </tr>
    <tr>
        <th>Email</th>
        <td>
            <?php echo $order['email']; ?>
        </td>
    </tr>
        <tr>
            <th>Ghi chú</th>
            <td>
                <?php echo $order['note']; ?>
            </td>
        </tr>
    <tr>
        <th>Tổng giá trị đơn hàng</th>
        <td>
            <?php echo number_format($order['price_total']); ?><sup>đ</sup>
        </td>
    </tr>
    <tr>
        <th>Tổng giá trị đơn hàng</th>
        <td>
            <?php echo number_format($order['price_total']); ?><sup>đ</sup>
        </td>
    </tr>

        <tr>
            <th>Hình thức thanh toán</th>
            <td>
                <?php
                $status_text = '<span class="status__disabled">Payment</span>';
                if ($order['payment_status'] == 0) {
                    $status_text = '<span class="status__active">Ship COD</span>';
                }
                echo $status_text;
                ?>
            </td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>
                <?php echo date('d-m-Y H:i:s', strtotime($order['created_at'])); ?>
            </td>
        </tr>
        <tr>
            <th>Ngày cập nhật</th>
            <td>
                <?php echo date('d-m-Y H:i:s', strtotime($order['updated_at'])); ?>
            </td>
        </tr>
</table>
<a class="btn btn-primary" href="index.php?controller=order">Back</a>


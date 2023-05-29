<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';

class PaymentController extends Controller
{
    public function index() {


        //nếu giỏ hàng trống thì ko cho phép truy cập trang này
        if (!isset($_SESSION['cart'])) {
            $_SESSION['error'] = 'Bạn chưa có sản phẩm nào trong giỏ hàng';
            header("Location: index.php");
            exit();
        }

        if(isset($_POST['submit'])){
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            $method = $_POST['method'];

            if (empty($fullname) || empty($address) || empty($mobile) || empty($email)) {
                $this->error = 'Họ tên, Địa chỉ, Số điện thoại, Email không được để trống';
            }

            if(empty($this->error)){
                $order_model = new Order();
                $order_model->fullname = $fullname;
                $order_model->address = $address;
                $order_model->mobile = $mobile;
                $order_model->email = $email;
                $order_model->note = $note;
                $price_total = 0;

                foreach ($_SESSION['cart'] as $cart) {
                    $price_total += $cart['quantity'] * $cart['price'];
                }

                $order_model->price_total = $price_total;
                //mặc định là chưa thanh toán
                $order_model->payment_status = 0;
                //lưu vào bảng orders
                $order_id = $order_model->insert();

                //xóa thông tin giỏ hàng đi
//          unset($_SESSION['cart']);
                //trường hợp chọn phương thức thanh toán là COD thì chuyển tới trang cảm ơn
                if($order_id > 0) {
                    $order_detail = new OrderDetail();
                    $order_detail->order_id = $order_id;
                    echo $order_id;

                    foreach ($_SESSION['cart'] AS $product_id => $cart){
                        $order_detail->product_id = $product_id;
                        $order_detail->product_name = $cart['name'];
                        $order_detail->product_price = $cart['price'];
                        $order_detail->quantity = $cart['quantity'];
                        $order_detail->insert();
                    }

                    //xóa thông tin giỏ hàng đi
//          unset($_SESSION['cart']);
                    //trường hợp chọn phương thức thanh toán là COD thì chuyển tới trang cảm ơn

                    if ($method == 1) {
//                        $order_model->id = $order_id;
//                        //lấy nội dung mail từ template có sẵn
//                        $body = $this->render('views/payments/mail_template_order.php', ['order' => $order_model]);
//                        //gửi mail xác nhận đã thanh toán
//                        Helper::sendMail($email, 'Subject', $body, 'vuongn6800@gmail.com' , 'umfelmcyogbsfjrh');
                        header("Location: index.php?controller=payment&action=thank");
                        exit();
                    }

                }else {
                    $this->error = 'Lưu thông tin thanh toán thất bại';
                }

            }



        }


        $this->content = $this->render('views/payments/index.php');
        require_once 'views/layouts/main.php';


    }

    public function thank()
    {
        //xóa thông tin giỏ hàng đi
        unset($_SESSION['cart']);
        $this->content = $this->render('views/payments/thank.php');
        require_once 'views/layouts/main.php';
    }

    public function payment()
    {

        $this->content = $this->render('libraries/nganluong/index.php');

        require_once 'views/layouts/main.php';
    }


}
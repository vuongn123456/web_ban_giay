<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';

class CartController extends Controller
{
    public function add() {
        // Lấy id từ ajax gửi lên
        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);
        $product_cart = [
            'name' => $product['title'],
            'price' => $product['price'],
            'avatar' => $product['avatar'],
            'quantity' => 1 //số lượng sp sẽ thêm vào giỏ
        ];
        // Nếu giỏ hàng chưa tồn tại, thì khởi tạo giỏ hàng và
        //thêm sp đầu tiên vào giỏ
        if (!isset($_SESSION['cart'])) {
//			$_SESSION['cart'] = [
//				$id => $product_cart
//			];
            $_SESSION['cart'][$id] = $product_cart;
        } else {
            // Có 2 trường hợp:
            // + Sp thêm đã tồn tại: update quantity
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity']++;
            } else {
                $_SESSION['cart'][$id] = $product_cart;
            }
            // + Sp thêm chưa tồn tại: thêm mới
        }
    }

    public function index() {

        if(empty($_SESSION['cart'])){
            header('Location: index.php');
            exit();
        }

        if(isset($_POST['submit'])){
            // Thử nhập số lượng âm trên giao diện r submir form xem có được ko ?
            // Bt ko submit đc do input có thuộc tính HTML5 min=0
            // Tuy nhiên nếu chỉnh sửa bằng Inspect HTML có thể bỏ đi thuộc tính này
            // -> vẫn submit đc form với số lượng âm!
            foreach ($_POST as $product_id => $quantity) {
                if(is_numeric($quantity) && $quantity<0) {
                    $_SESSION['error'] = 'Số lượng phải lớn hơn 0';
                    header('Location: index.php?controller=cart&action=index');
                    exit();
                }
            }

            // Design pattern:
            // Lặp mảng giỏ hàng, set lại số lượng mới cho từng cart

            foreach ($_SESSION['cart'] AS $product_id => $cart) {
                $_SESSION['cart'][$product_id]['quantity'] = $_POST[$product_id];
            }

            $_SESSION['success'] = 'Cập nhật giỏ thành công';


        }




        $this->page_title = 'Giỏ hàng của bạn';
        $this->content = $this->render('views/carts/index.php');
        require_once 'views/layouts/main.php';
    }

    public function delete() {
        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]);
        $_SESSION['success'] = 'Xóa sản phẩm khỏi giỏ thành công';
        header('Location:index.php?controller=cart&action=index');
        exit();
        // THam khảo tính năng gửi mail với thư viện PHPMailer
        //, cần tạo mật khẩu ứng dụng Gmail để có username và
        //password cần thiết cho việc gửi mail

    }
}
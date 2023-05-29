<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';

class OrderController extends Controller
{

    public function index(){
        $order_model = new Order();

        $orders = $order_model->getAll();

        $this->content = $this->render('views/orders/index.php', [
            //truyền biến $categories ra vew
            'orders' => $orders,
            //truyền biến phân trang ra view
        ]);

        //gọi layout để nhúng thuộc tính $this->content
        require_once 'views/layouts/main.php';
    }

    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=order&action=index');
            exit();
        }
        $id = $_GET['id'];
        $order_model = new Order();
        $orders = $order_model->getOrderById($id);

        //lấy nội dung view create.php
        $this->content = $this->render('views/orders/detail.php', [
            'orders' => $orders
        ]);
        //gọi layout để nhúng nội dung view detail vừa lấy đc
        require_once 'views/layouts/main.php';

    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=order&action=index');
            exit();
        }
        $id = $_GET['id'];
        $order_model = new Order();
        $is_delete = $order_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa thành công';
        } else {
            $_SESSION['error'] = 'Xóa thất bại';
        }
        header('Location: index.php?controller=order&action=index');
        exit();
    }

}

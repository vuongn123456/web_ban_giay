<?php
//backend/controllers/UserController.php
require_once 'controllers/Controller.php';
require_once 'models/User.php';
class UserController extends Controller {
	// index.php?controller=user&action=register
    public function register() {
        // + NẾu submit form thì mới xử lý
        if (isset($_POST['submit'])) {
            // + Tạo biến trung gian
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['confirm_password'];
            // + Validate form:
            // Ko đc để trống các trường
            // Password và password confirm phải trùng nhau
            if (empty($username) || empty($password) || empty($password_confirm)) {
                $this->error = "Ko đc để trống các trường";
            } elseif ($password != $password_confirm) {
                $this->error = "Password confirm chưa đúng";
            }
            // + Xử lý logic chính chỉ khi nào ko có lỗi nào xảy ra
            if (empty($this->error)) {
                // + Gọi model để tương tác với CSDL
                $user_model = new User();

                // Xử lý nếu username chưa tồn tại thì mới đăng ký tài khoản
                $user = $user_model->getUser($username);
                // NẾu mảng user khác rỗng, đã tồn tại user, thì báo lỗi, ko cho đky tài khoản
                if (!empty($user)) {
                    $this->error = "Tên đăng nhập $username đã tồn tại, ko thể đăng ký tài khoản";
                } else {
                    // Truyền giá trị thật từ form cho thuộc tính của class User trước khi gọi phương thức
                    //register
                    $user_model->username = $username;
                    //$user_model->password = $password; // chú ý ko đc gán trực tiếp plaintext của password
                    // Cần mã hóa password trước khi lưu vào CSDL: md5 -> demo
                    // Dùng hàm password_hash để mã hóa password, độ bảo mật cao
                    // Cùng 1 giá trị password -> mã hóa thành các chuỗi khác nhau
                    // Với md5: cùng 1 giá trị password -> mã hóa thành 1 chuỗi giống nhau
                    $user_model->password = password_hash($password, PASSWORD_BCRYPT);
//          var_dump($user_model->password);
                    $is_register = $user_model->register();
//          var_dump($is_register);
                    if ($is_register) {
                        // Chuyển hướng về trang login sau khi đky thành công
                        header("Location: index.php?controller=user&action=login");
                        exit();
                    }
                }

            }
        }

        // Gọi view
        // + Lấy nội dung view:
        $this->content = $this->render('views/users/register.php');
        // + Gọi layout để hiển thị, cần tạo 1 layout khác để hiển thị
        // Copy file layout chính, giữ nguyên nhúng file css, js, chỉ thay đổi phần body cho
        // phù hợp -> copy file main.php -> main_login.php
        require_once 'views/layouts/main_user.php';
    }

	public function login(){

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            // + Validate form: ko đc để trống
            if (empty($username) || empty($password)) {
                $this->error = "Phải nhập các trường";
            }

            // + Xử lý logic chính chỉ khi ko có lỗi nào xảy ra:
            if(empty($this->error)){
                $user_model = new User();
                $user = $user_model->getUser($username);

                if(empty($user)){
                    $this->error = "Username không tồn tại";
                }else{
                    $password_encrypt = $user['password'];
                    // + Sử dụng hàm password_verify của PHP để ktra cái password đã mã hóa này từ password nhập từ form
                    // Hàm này sử dụng cho password đc mã hóa bằng hàm password_hash
                    $is_verify_password = password_verify($password,$password_encrypt);

                    if($is_verify_password){
                        $_SESSION['user'] = $user;
                        $_SESSION['success'] = 'Đăng nhập thành công';
                        // Chuyển hướng về giao diện admin
                        header('Location: index.php?controller=category&action=index');
                        exit();
                    }else{
                        $this->error = 'Sai tài khoản hoặc mật khẩu';
                    }
                }

            }


        }



        $this->page_title = 'Form đăng nhập';
        $this->content =  $this->render('views/users/login.php');

        require_once 'views/layouts/main_user.php';
    }


    // Xử lý đăng xuất user
    public function logout() {
        // Xóa các session liên quan đến user, chuyển hướng về trang login
        unset($_SESSION['user']);
        $_SESSION['success'] = 'Đăng xuất thành công';
        header('Location: index.php?controller=user&action=login');
        exit();
    }

}

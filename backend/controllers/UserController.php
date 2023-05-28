<?php
//backend/controllers/UserController.php
    require_once 'controllers/Controller.php';
    require_once 'models/User.php';

    class UserController {

        public $content;
        //chứa nội dung lỗi validate
        public $error;

        /**
         * @param $file string Đường dẫn tới file
         * @param array $variables array Danh sách các biến truyền vào file
         * @return false|string
         */
        public function render($file, $variables = []) {
            //Nhập các giá trị của mảng vào các biến có tên tương ứng chính là key của phần tử đó.
            //khi muốn sử dụng biến từ bên ngoài vào trong hàm
            extract($variables);
            //bắt đầu nhớ mọi nội dung kể từ khi khai báo, kiểu như lưu vào bộ nhớ tạm
            ob_start();
            //thông thường nếu ko có ob_start thì sẽ hiển thị 1 dòng echo lên màn hình
            //tuy nhiên do dùng ob_Start nên nội dung của nó đã đc lưu lại, chứ ko hiển thị ra màn hình nữa
            require_once $file;
            //lấy dữ liệu từ bộ nhớ tạm đã lưu khi gọi hàm ob_Start để xử lý, lấy xong rồi xóa luôn dữ liệu đó
            $render_view = ob_get_clean();

            return $render_view;
        }


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

        if (isset($_SESSION['user'])) {
            header('Location: index.php?controller=category&action=index');
            exit();
        }

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
                    $this->error = "Tên đăng nhập không tồn tại";
                }else{
                    $password_encrypt = $user['password'];
                    // + Sử dụng hàm password_verify của PHP để ktra cái password đã mã hóa này từ password nhập từ form
                    // Hàm này sử dụng cho password đc mã hóa bằng hàm password_hash
                    $is_verify_password = password_verify($password,$password_encrypt);

                    if($is_verify_password && $user['status'] == 1){
                        $_SESSION['user'] = $user;
                        $_SESSION['success'] = 'Đăng nhập thành công';
                        // Chuyển hướng về giao diện admin
                        header('Location: index.php?controller=category&action=index');
                        exit();
                    }elseif ($user['status'] !== 1 && $is_verify_password){
                        $this->error = "Bạn không có quyền quản trị";
                    } else{
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
        $_SESSION = [];
        session_destroy();
//        unset($_SESSION['user']);
        $_SESSION['success'] = 'Đăng xuất thành công';
        header('Location: index.php?controller=user&action=login');
        exit();
    }



}

<?php

    require_once 'controllers/Controller.php';
    require_once 'models/Brand.php';

    class BrandController extends Controller{

        public function index(){
            $brand_model = new Brand();

            $brands = $brand_model->getAll();

            $this->content = $this->render('views/brands/index.php', [
                //truyền biến $categories ra vew
                'brands' => $brands,
                //truyền biến phân trang ra view
            ]);

            //gọi layout để nhúng thuộc tính $this->content
            require_once 'views/layouts/main.php';
        }

        public function create()
        {
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $description = $_POST['descriptionn'];
                $status = $_POST['status'];
                $avatar_files = $_FILES['avatar'];

                //check validate
                if (empty($name)) {
                    $this->error = 'Cần nhập tên';
                } //trường hợp có ảnh upload lên, thì cần kiểm tra điều kiện là file ảnh
                else if ($avatar_files['error'] == 0) {
                    $extension_arr = ['jpg', 'jpeg', 'gif', 'png'];
                    $extension = pathinfo($avatar_files['name'], PATHINFO_EXTENSION);
                    $extension = strtolower($extension);
                    $file_size_mb = $avatar_files['size'] / 1024 / 1024;
                    //làm tròn theo đơn vị thập phân
                    $file_size_mb = round($file_size_mb, 2);

                    if (!in_array($extension, $extension_arr)) {
                        $this->error = 'Cần upload file định dạng ảnh';
                    } else if ($file_size_mb >= 2) {
                        $this->error = 'File upload không được lớn hơn 2Mb';
                    }
                }

                //nếu ko có lỗi thì tiến hành lưu dữ liệu và upload ảnh nếu có
                $avatar = '';
                if (empty($this->error)) {
                    //xử lý upload ảnh nếu có
                    if ($avatar_files['error'] == 0) {
                        $dir_uploads = 'assets/uploads';
                        if (!file_exists($dir_uploads)) {
                            mkdir($dir_uploads);
                        }
                        $avatar = time() . '-' . $avatar_files['name'];
                        move_uploaded_file($avatar_files['tmp_name'], $dir_uploads . '/' . $avatar);
                    }
                    //lưu vào csdl
                    //gọi model để thực  hiện lưu
                    $brand_model = new Brand();
                    //gán các giá trị từ form cho các thuộc tính của category
                    $brand_model->name = $name;
                    $brand_model->avatar = $avatar;
                    $brand_model->description = $description;
                    $brand_model->status = $status;
                    //gọi phương thức insert
                    $is_insert = $brand_model->insert();
                    if ($is_insert) {
                        $_SESSION['success'] = 'Thêm mới thành công';
                    } else {
                        $_SESSION['error'] = 'Thêm mới thất bại';
                    }
                    header('Location: index.php?controller=brand&action=index');
                    exit();
                }

            }

            //lấy nội dung view create.php
            $this->content = $this->render('views/brands/create.php');
            //gọi layout để nhúng nội dung view create vừa lấy đc
            require_once 'views/layouts/main.php';
        }

        public function update(){

            if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
                $_SESSION['error'] = 'ID category không hợp lệ';
                header('Location: index.php?controller=category&action=index');
                exit();
            }

            $id = $_GET['id'];
            $brand_model = new Brand();
            $brand = $brand_model->getBrandById($id);

            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $description = $_POST['descriptionn'];
                $status = $_POST['status'];
                $avatar_files = $_FILES['avatar'];

//        Validate
                if(empty($name)){
                    $this->error = 'Cần nhập tên';
                }elseif ($avatar_files['error'] == 0){
                    $extension_arr = ['jpg', 'jpeg', 'gif', 'png'];
                    $extension = pathinfo($avatar_files['name'], PATHINFO_EXTENSION); //lấy thông tin về đường dẫn truyền vào.
                    $extension = strtolower($extension);//chuyển đổi các kí tự trong chuỗi thành kí tự in thường
                    $file_size_mb = $avatar_files['size'] / 1024 / 1024;
                    $file_size_mb = round($file_size_mb , 2);//làm tròn theo đơn vị thập phân

                    if(!in_array($extension, $extension_arr)){
                        $this->error = 'Cần upload file định dạng ảnh';
                    }elseif ($file_size_mb >= 2){
                        $this->error = 'File upload không được lớn hơn 2Mb';
                    }
                }

//        Upload dữ liệu và ảnh nếu có
                $avatar = $brand['avatar'];
                if(empty($this->error)){
                    //Xử lý upload ảnh nếu có
                    if($avatar_files['error'] == 0){
                        //Xóa file ảnh cũ
                        $dir_uploads = 'assets/uploads';
                        if (!file_exists($dir_uploads)) {
                            mkdir($dir_uploads);
                        }
                        //xóa file ảnh cũ đi
                        @unlink($dir_uploads . '/' . $avatar);
                        //tạo tên file mới và save
                        $avatar = time() . '-' . $avatar_files['name'];

                        move_uploaded_file($avatar_files['tmp_name'], $dir_uploads . '/' . $avatar);
                    }

                    $brand_model = new Brand();
                    //gán các giá trị từ form cho các thuộc tính của category
                    $brand_model->name = $name;
                    $brand_model->avatar = $avatar;
                    $brand_model->description = $description;
                    $brand_model->status = $status;
                    $brand_model->updated_at = date('Y-m-d H:i:s');
                    //gọi phương thức update theo id
                    $is_update = $brand_model->update($id);
                    if ($is_update) {
                        $_SESSION['success'] = 'Cập nhật thành công';
                    } else {
                        $_SESSION['error'] = 'Cập nhật thất bại';
                    }
                    header('Location: index.php?controller=brand&action=index');
                    exit();
                }
            }


            //lấy nội dung view create.php
            $this->content = $this->render('views/brands/update.php', ['brand' => $brand]);
            //gọi layout để nhúng nội dung view create vừa lấy đc
            require_once 'views/layouts/main.php';
        }

        public function delete()
        {
            if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                $_SESSION['error'] = 'ID không hợp lệ';
                header('Location: index.php?controller=brand&action=index');
                exit();
            }
            $id = $_GET['id'];
            $brand_model = new Brand();
            $is_delete = $brand_model->delete($id);
            if ($is_delete) {
                $_SESSION['success'] = 'Xóa thành công';
            } else {
                $_SESSION['error'] = 'Xóa thất bại';
            }
            header('Location: index.php?controller=brand&action=index');
            exit();
        }

        public function detail()
        {
            if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                $_SESSION['error'] = 'ID không hợp lệ';
                header('Location: index.php?controller=brand&action=index');
                exit();
            }
            $id = $_GET['id'];
            $brand_model = new Brand();
            $brand = $brand_model->getBrandById($id);
            //lấy nội dung view create.php
            $this->content = $this->render('views/brands/detail.php', [
                'brand' => $brand
            ]);
            //gọi layout để nhúng nội dung view detail vừa lấy đc
            require_once 'views/layouts/main.php';

        }
    }

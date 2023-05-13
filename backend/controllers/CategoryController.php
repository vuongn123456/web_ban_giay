<?php
require_once 'controllers/Controller.php';
require_once 'models/Category.php';

class CategoryController extends Controller
{

  public function index(){
    $category_model = new Category();

    $categories = $category_model->getAll();

    $this->content = $this->render('views/categories/index.php', [
      //truyền biến $categories ra vew
      'categories' => $categories,
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
        $category_model = new Category();
        //gán các giá trị từ form cho các thuộc tính của category
        $category_model->name = $name;
        $category_model->avatar = $avatar;
        $category_model->description = $description;
        $category_model->status = $status;
        //gọi phương thức insert
        $is_insert = $category_model->insert();
        if ($is_insert) {
          $_SESSION['success'] = 'Thêm mới thành công';
        } else {
          $_SESSION['error'] = 'Thêm mới thất bại';
        }
        header('Location: index.php?controller=category&action=index');
        exit();
      }

    }

    //lấy nội dung view create.php
    $this->content = $this->render('views/categories/create.php');
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
    $category_model = new Category();
    $category = $category_model->getCategoryById($id);

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
        $avatar = $category['avatar'];
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

            $category_model = new Category();
            //gán các giá trị từ form cho các thuộc tính của category
            $category_model->name = $name;
            $category_model->avatar = $avatar;
            $category_model->description = $description;
            $category_model->status = $status;
            $category_model->updated_at = date('Y-m-d H:i:s');
            //gọi phương thức update theo id
            $is_update = $category_model->update($id);
            if ($is_update) {
                $_SESSION['success'] = 'Cập nhật thành công';
            } else {
                $_SESSION['error'] = 'Cập nhật thất bại';
            }
            header('Location: index.php?controller=category&action=index');
            exit();
        }
    }


      //lấy nội dung view create.php
      $this->content = $this->render('views/categories/update.php', ['category' => $category]);
      //gọi layout để nhúng nội dung view create vừa lấy đc
      require_once 'views/layouts/main.php';
  }

  public function delete()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'ID không hợp lệ';
      header('Location: index.php?controller=category&action=index');
      exit();
    }
    $id = $_GET['id'];
    $category_model = new Category();
    $is_delete = $category_model->delete($id);
    if ($is_delete) {
      $_SESSION['success'] = 'Xóa thành công';
    } else {
      $_SESSION['error'] = 'Xóa thất bại';
    }
    header('Location: index.php?controller=category&action=index');
    exit();
  }

  public function detail()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'ID không hợp lệ';
      header('Location: index.php?controller=category&action=index');
      exit();
    }
    $id = $_GET['id'];
    $category_model = new Category();
    $category = $category_model->getCategoryById($id);
    //lấy nội dung view create.php
    $this->content = $this->render('views/categories/detail.php', [
      'category' => $category
    ]);
    //gọi layout để nhúng nội dung view detail vừa lấy đc
    require_once 'views/layouts/main.php';

  }
}

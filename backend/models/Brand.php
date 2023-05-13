<?php

    require_once 'models/Model.php';

    class Brand extends Model {
        //khai báo các thuộc tính cho model trùng với các trường
    //    của bảng categories
        public $id;
        public $name;
        public $avatar;
        public $description;
        public $status;
        public $created_at;
        public $updated_at;

        //insert dữ liệu vào bảng categories
        public function insert() {
            $sql_insert =
                "INSERT INTO brands(`name`, `avatar`, `description`, `status`)
    VALUES (:name, :avatar, :description, :status)";
            //cbi đối tượng truy vấn
            $obj_insert = $this->connection
                ->prepare($sql_insert);
            //gán giá trị thật cho các placeholder
            $arr_insert = [
                ':name' => $this->name,
                ':avatar' => $this->avatar,
                ':description' => $this->description,
                ':status' => $this->status
            ];
            return $obj_insert->execute($arr_insert);
        }



        public function getAll() {

            $sql_select_all = "SELECT * FROM brands";
            $obj_select_all = $this->connection
                ->prepare($sql_select_all);
            $obj_select_all->execute();
            $brands = $obj_select_all
                ->fetchAll(PDO::FETCH_ASSOC);
            return $brands;
        }

        public function getById($id) {
            $sql_select_one = "SELECT * FROM brands WHERE id = :id";
            $obj_select_one = $this->connection
                ->prepare($sql_select_one);
            $selects = [
                ':id' => $id
            ];

            $obj_select_one->execute($selects);
            $category = $obj_select_one->fetch(PDO::FETCH_ASSOC);
            return $category;
        }

        public function getBrandById($id)
        {
            $obj_select = $this->connection
                ->prepare("SELECT * FROM brands WHERE id = $id");
            $obj_select->execute();
            $brand = $obj_select->fetch(PDO::FETCH_ASSOC);

            return $brand;
        }


        public function update($id)
        {
            $obj_update = $this->connection->prepare("UPDATE brands SET `name` = :name, `avatar` = :avatar, `description` = :description, `status` = :status, `updated_at` = :updated_at 
         WHERE id = $id");
            $arr_update = [
                ':name' => $this->name,
                ':avatar' => $this->avatar,
                ':description' => $this->description,
                ':status' => $this->status,
                ':updated_at' => $this->updated_at,
            ];

            return $obj_update->execute($arr_update);
        }



        public function delete($id)
        {
            $obj_delete = $this->connection
                ->prepare("DELETE FROM brands WHERE id = $id");
            $is_delete = $obj_delete->execute();
            //để đảm bảo toàn vẹn dữ liệu, sau khi xóa brand thì cần xóa cả các product nào đang thuộc về brand này
            $obj_delete_product = $this->connection
                ->prepare("DELETE FROM products WHERE brand_id = $id");
            $obj_delete_product->execute();

            return $is_delete;
        }

        public function countTotal()
        {
            $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM categories");
            $obj_select->execute();

            return $obj_select->fetchColumn();
        }

    }

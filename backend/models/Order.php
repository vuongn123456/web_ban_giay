<?php
//models/Category
require_once 'models/Model.php';

class Order extends Model {
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
            "INSERT INTO categories(`name`, `avatar`, `description`, `status`)
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

        $sql_select_all = "SELECT * FROM orders";
        $obj_select_all = $this->connection
            ->prepare($sql_select_all);
        $obj_select_all->execute();
        $orders = $obj_select_all
            ->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }

    public function getById($id) {
        $sql_select_one = "SELECT * FROM order_details WHERE order_id = :id";
        $obj_select_one = $this->connection
            ->prepare($sql_select_one);
        $selects = [
            ':id' => $id
        ];

        $obj_select_one->execute($selects);
        $category = $obj_select_one->fetchAll(PDO::FETCH_ASSOC);
        return $category;
    }


    public function getOrderById($id)
    {
        $sql_select = "SELECT
    orders.*,
    order_details.product_name,
    order_details.product_price,
    order_details.quantity
FROM
    orders
INNER JOIN order_details ON orders.id = order_details.order_id
WHERE
    orders.id = :id;";
        $obj_select = $this->connection->prepare($sql_select);
        $selects = [
            ':id' => $id
        ];

        $obj_select->execute($selects);
        $orders = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }


    public function update($id)
    {
        $obj_update = $this->connection->prepare("UPDATE categories SET `name` = :name, `avatar` = :avatar, `description` = :description, `status` = :status, `updated_at` = :updated_at 
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
            ->prepare("DELETE FROM categories WHERE id = $id");
        $is_delete = $obj_delete->execute();
        //để đảm bảo toàn vẹn dữ liệu, sau khi xóa category thì cần xóa cả các product nào đang thuộc về category này
        $obj_delete_product = $this->connection
            ->prepare("DELETE FROM products WHERE category_id = $id");
        $obj_delete_product->execute();

        return $is_delete;
    }

    /**
     * Lấy tổng số bản ghi trong bảng categories
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM categories");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

}

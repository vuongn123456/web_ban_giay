<?php

    require_once 'models/Model.php';



class Product extends Model {

    public $page;

    public function getProductInHomePage($params = []) {
        $str_filter = '';
        $row = 9;
        $from = ($this->page - 1 ) * $row;


        if (isset($params['category'])) {
            $str_category = $params['category'];
            $str_filter .= " AND categories.id IN $str_category";
        }
        if (isset($params['price'])) {
            $str_price = $params['price'];
            $str_filter .= " AND $str_price";
        }
        //do cả 2 bảng products và categories đều có trường name, nên cần phải thay đổi lại tên cột cho 1 trong 2 bảng
        $sql_select = "SELECT products.*, categories.name 
          AS category_name FROM products
          INNER JOIN categories ON products.category_id = categories.id
          WHERE products.status = 1 $str_filter ORDER BY
    products.created_at
DESC
LIMIT $from, $row;";

        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();

        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }


    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT
    COUNT(id)
FROM
    products
WHERE
    products.status = 1;");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

    /**
     * Lấy thông tin sản phẩm theo id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name FROM products 
          INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $id");

        $obj_select->execute();
        $product =  $obj_select->fetch(PDO::FETCH_ASSOC);
        return $product;
    }
}


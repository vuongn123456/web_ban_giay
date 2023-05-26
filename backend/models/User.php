<?php
//models/User.php
require_once 'models/Model.php';
class User extends Model {

    public function getUser($username) {
        // + Viết truy vấn dạng tham số
        $sql_select_one = "SELECT * FROM users WHERE username=:username";
        // + Cbi obj truy vấn:
        $obj_select_one = $this->connection->prepare($sql_select_one);
        // + Tạo mảng:
        $selects = [
            ':username' => $username
        ];
        // + Thực thi obj truy vấn:
        $obj_select_one->execute($selects);
        // + Lấy mảng 1 chiều:
        $user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function register() {
        // + Viết truy vấn dạng tham số, SQLInjection
        $sql_insert = "INSERT INTO users(username, password) VALUES(:username, :password)";
        // + Cbi obj truy vấn: prepare
        $obj_insert = $this->connection->prepare($sql_insert);
        // + Tạo mảng truyền giá trị tham số câu truy vấn:
        $inserts = [
            ':username' => $this->username,
            ':password' => $this->password
        ];
        // + Thực thi obj truy vấn: execute
        $is_register = $obj_insert->execute($inserts);
        return $is_register;
    }

    public function insert(){
        $obj_insert = $this->connection
            ->prepare("INSERT INTO users(username, password, first_name, last_name, phone, address, email, avatar, jobs, facebook, status)
VALUES(:username, :password, :first_name, :last_name, :phone, :address, :email, :avatar, :jobs, :facebook, :status)");
        $arr_insert = [
            ':username' => $this->username,
            ':password' => $this->password,
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':phone' => $this->phone,
            ':address' => $this->address,
            ':email' => $this->email,
            ':avatar' => $this->avatar,
            ':jobs' => $this->jobs,
            ':facebook' => $this->facebook,
            ':status' => $this->status,
        ];
        return $obj_insert->execute($arr_insert);
    }

}

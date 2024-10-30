<?php

require_once 'config/Database.php';
require_once 'Model/SelectData.php';

class Users {
    private $id;
    private $stutti_id;
    private $password;
    private $name;
    private $mail_address;
    private $avatar;
    private $conn;

    // TODO: プロパティを private に変更する？
    // TODO: ⇒各プロパティに対してgetter(),setter()用意

    private function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function createUser() {
        $query = "INSERT INTO users (stutti_id, password, name, mail_address, avatar) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(1, $this->stutti_id);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->name);
        $stmt->bindParam(4, $this->mail_address);
        $stmt->bindParam(5, $this->avatar);

        return $stmt->execute();
    }

    // 会員情報更新
    function updateUsers($mail_address, $stuttiId, $password, $name, $avater, $id) {
        $query = "UPDATE `users` SET `users`.`mail_address` = ?, `users`.`stutti_id` = ?, `users`.`password` = ?, `users`.`name` = ?, `users`.`avater` = ? WHERE `users`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $mail_address);
        $stmt->bindValue(2, $stuttiId);
        $stmt->bindValue(3, $password);
        $stmt->bindValue(4, $name);
        $stmt->bindValue(5, $avater);
        $stmt->bindValue(6, $id);
        $stmt->execute();
    }

    // 会員情報削除

    function deleteUsers($id) {
        $query = "UPDATE `users` SET `users`.`delete_flag` = 1  WHERE `users`.`id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    public function login() {
        $query = "SELECT * FROM users WHERE stutti_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->stutti_id);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($this->password, $user['password'])) {
            $this->id = $user['id'];
            $this->name = $user['name'];
            return true;
        }
        return false;
    }
}

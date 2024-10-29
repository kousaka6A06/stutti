<?php

require_once 'config/Database.php';

class User {
    private $conn;
    public $id;
    public $login_id;
    public $password;
    public $name;
    public $mail_address;
    public $avatar;

    // TODO: プロパティを private に変更する？
    // TODO: ⇒各プロパティに対してgetter(),setter()用意

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function createUser() {
        $query = "INSERT INTO user (login_id, password, name, mail_address, avatar) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(1, $this->login_id);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->name);
        $stmt->bindParam(4, $this->mail_address);
        $stmt->bindParam(5, $this->avatar);

        return $stmt->execute();
    }

    public function login() {
        $query = "SELECT * FROM user WHERE login_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->login_id);
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

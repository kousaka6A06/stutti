<?php
require_once 'config/Database.php';

class User {
    private $id;
    private $stuttiId;
    private $password;
    private $name;
    private $mailAddress;
    private $avatar;
    private $deleteFlag;
    private $adminFlag;
    private $createdAt;
    private $updatedAt;
    private $conn;

    // TODO: プロパティを private に変更する？
    // TODO: ⇒各プロパティに対してgetter(),setter()用意

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function createUser() {
        $query = "INSERT INTO users (stutti_id, password, name, mail_address, avatar) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(1, $this->stuttiId);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->name);
        $stmt->bindParam(4, $this->mailAddress);
        $stmt->bindParam(5, $this->avatar);

        return $stmt->execute();
    }

    // 会員情報更新
    function updateUser($mailAddress, $stuttiId, $password, $name, $avater, $id) {
        $query = "UPDATE `users` SET `users`.`mail_address` = ?, `users`.`stutti_id` = ?, `users`.`password` = ?, `users`.`name` = ?, `users`.`avater` = ? WHERE `users`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $mailAddress);
        $stmt->bindValue(2, $stuttiId);
        $stmt->bindValue(3, $password);
        $stmt->bindValue(4, $name);
        $stmt->bindValue(5, $avater);
        $stmt->bindValue(6, $id);
        $stmt->execute();
    }

    // 会員情報削除
    function deleteUser($id) {
        $query = "UPDATE `users` SET `users`.`delete_flag` = 1  WHERE `users`.`id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    public function login() {
        $query = "SELECT * FROM `users` WHERE stutti_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->stuttiId);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($this->password, $user['password'])) {
            $this->id = $user['id'];
            $this->name = $user['name'];
            return true;
        }
        return false;
    }

    // setter
    function setId($id) {
        $this->id = $id;
    }
    function setMailAddress($mailAddress) {
        $this->mailAddress = $mailAddress;
    }
    function setStuttiId($stuttiId) {
        $this->stuttiId = $stuttiId;
    }
    function setPassword($password) {
        $this->password = $password;
    }
    function setName($name) {
        $this->name = $name;
    }
    function setAvatar($avatar) {
        $this->avatar = $avatar;
    }
    function setDeleteFlag($deleteFlag) {
        $this->deleteFlag = $deleteFlag;
    }
    function setAdminFlag($adminFlag) {
        $this->adminFlag = $adminFlag;
    }
    function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }
    function setUpdatedAt($updatedAt) {
        $this->updateAt = $updatedAt;
    }

    // getter
    function getId():int {
        return $this->id;
    }
    function getMailAddress():string {
        return $this->mailAddress;
    }
    function getStuttiId():string {
        return $this->stuttiId;
    }
    function getPassword():string {
        return $this->password;
    }
    function getName():string {
        return $this->name;
    }
    function getAvatar():string {
        return $this->avatar;
    }
    function getDeleteFlag():bool {
        return $this->deleteFlag;
    }
    function getAdminFlag():bool {
        return $this->adminFlag;
    }
    function getCreatedAt():string {
        return $this->createdAt;
    }
    function getUpdatedAt():string {
        return $this->updatedAt;
    }


}

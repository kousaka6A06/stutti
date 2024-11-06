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
        $query = "INSERT INTO `users` (`users`.`stutti_id`, `users`.`password`, `users`.`name`, `users`.`mail_address`, `users`.`avatar`) VALUES (?, ?, ?, ?, ?)";
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
    function updateUser() {
        $query = "UPDATE `users` SET `users`.`mail_address` = ?, `users`.`stutti_id` = ?, `users`.`password` = ?, `users`.`name` = ?, `users`.`avater` = ? WHERE `users`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $this->mailAddress);
        $stmt->bindValue(2, $this->stuttiId);
        $stmt->bindValue(3, $this->password);
        $stmt->bindValue(4, $this->name);
        $stmt->bindValue(5, $this->avatar);
        $stmt->bindValue(6, $this->id);
        $stmt->execute();
    }

    // 会員情報削除
    function deleteUser() {
        $query = "UPDATE `users` SET `users`.`delete_flag` = 1  WHERE `users`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $this->id);
        $stmt->execute();
    }

    public function login() {
        $query = "SELECT * FROM `users` WHERE `users`.`stutti_id` = ?";
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
    // //////////////////// ユーザー関連
    // // ログイン
    // function LoginUser($loginId) {
    //     $query = "SELECT `users`.`stutti_id`,`users`.`password`, `users`.`name` FROM `users` WHERE `users`.`id` = ?";
    //     $stmt = $this->conn->prepare($query);

    //     $stmt->bindValue(1,$loginId,PDO::PARAM_INT);
    //     $stmt->execute();
    //     $ary = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $ary;
    // }

    // マイページ表示
    function userInfo() {
        $query = "SELECT `users`.`id`, `users`.`mail_address`, `users`.`stutti_id`,`users`.`name`, `users`.`avater`, `users`.`created_at` FROM `users` WHERE `users`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1,$this->id,PDO::PARAM_INT);
        $stmt->execute();
        $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }

    // ファイル保存用
    function registerAvatar() : int {
        $upfile = $_FILES['avatar'];
        if ($upfile['error'] !== UPLOAD_ERR_OK) {
            return 40 + $upfile['error'];
        }
        $ufName = $upfile['name'];
        $ufExtention = strtolower(pathinfo($ufName)['extension']);
        $availableExt = ['gif', 'jpg', 'jpeg', 'png'];
        if (!in_array($ufExtention, $availableExt)) {
            return 51;
        }
        $ufTmpname = $upfile['tmp_name'];
        $ufMimeType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $ufTmpname);
        $availableMType = ['image/gif', 'image/jpg', 'image/jpeg', 'image/png'];
        if (!in_array($ufMimeType, $availableMType)) {
            return 52;
        }
        $dt = new DateTime();
        $this->avatar = $dt->format('u') . $ufName;
        if (!move_uploaded_file($ufTmpname, 'images/' . $this->avatar)) {
            return 53;
        }
        return 0;
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
        $this->updatedAt = $updatedAt;
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

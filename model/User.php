<?php
require_once 'config/constants.php';
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

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }


    // ユーザー登録
    // userRegister.php
    public function createUser() {
        $query = "INSERT INTO `users` (`users`.`stutti_id`, `users`.`password`, `users`.`name`, `users`.`mail_address`, `users`.`avatar`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(1, $this->stuttiId);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->name);
        $stmt->bindParam(4, $this->mailAddress);
        $stmt->bindParam(5, $this->avatar);

        try {
            if ($stmt->execute()) {
                $this->id = $this->conn->lastInsertId();
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("createUser:" .$e->getMessage());
            return false;
        }
    }

    // stutti_id 重複チェック
    // 重複していなければ、真を返却
    // userRegister.php userEdit.php
    function isUniqueStuttiId() {
        $query = "SELECT `users`.`stutti_id` FROM `users` WHERE `users`.`stutti_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->stuttiId);
        
        // return $stmt->fetch(PDO::FETCH_COLUMN);
        try {
            if ($stmt->execute()) {
                if(!$stmt->fetch(PDO::FETCH_COLUMN)) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            error_log("isUniqueStuttiId:" .$e->getMessage());
            return false;
        }
    }
            

    // mail_address 重複チェック
    // 重複していなければ、真を返却
    // userRegister.php userEdit.php
    function isUniqueMailAddress() {
        $query = "SELECT `users`.`mail_address` FROM `users` WHERE `users`.`mail_address` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->mailAddress);
        
        try {
            if ($stmt->execute()) {
                if(!$stmt->fetch(PDO::FETCH_COLUMN)) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            error_log("isUniqueMailAddress:" .$e->getMessage());
            return false;
        } 
    }  

    // パスワードバリデーションチェック
    // 8文字以上・大文字小文字英数記号!@;: 3種以上を利用
    // 
    public function isMatchPassword() {
        $pregPassword = "/^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])|(?=.*[a-z])(?=.*[A-Z])(?=.*[!@;:])|(?=.*[A-Z])(?=.*[0-9])(?=.*[!@;:])|(?=.*[a-z])(?=.*[0-9])(?=.*[!@;:]))([a-zA-Z0-9!@;:]){8,}$/";
        if(preg_match($pregPassword, $this->password)) {
            return true;
        } else {
            return false;
        }
    }
    // メールアドレスバリデーションチェック
    // @の直後は、ドットではない
    // 
    public function isMatchMailAddress() {
        $pregEmail = "/\A([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+\z/"; 

        if(preg_match($pregEmail, $this->mailAddress)) {
            return true;
        } else {
            return false;
        }
    }

    // 〇ユーザー情報更新
    // userEdit.php
    function updateUser() {
        $query = "UPDATE `users` SET `users`.`mail_address` = ?, `users`.`password` = ?, `users`.`name` = ?, `users`.`avatar` = ? WHERE `users`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindValue(1, $this->mailAddress);
        $stmt->bindValue(2, $this->password);
        $stmt->bindValue(3, $this->name);
        $stmt->bindValue(4, $this->avatar);
        $stmt->bindValue(5, $this->id);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("updateUser:" . $e->getMessage());
            return false;
        }
        
    }

    // 〇ユーザー情報論理削除
    // userDelete.php
    function deleteUser() {
        $query = "UPDATE `users` SET `users`.`delete_flag` = 1  WHERE `users`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $this->id);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("deleteUser:" .$e->getMessage());
            return false;
        }
    }

    // 〇ログイン処理
    // login.php
    public function login() {
        $query = "SELECT * FROM `users` WHERE `users`.`stutti_id` = ? AND `users`.`delete_flag` = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->stuttiId);
        try {
            if ($stmt->execute()) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user && password_verify($this->password, $user['password'])) {
                    $this->id = $user['id'];
                    $this->name = $user['name'];
                    return true;
                }
            } 
            return false;
        } catch (PDOException $e) {
            error_log("login:" .$e->getMessage());
            return false;
        }          
    }

    // // ログイン
    // function LoginUser($loginId) {
    //     $query = "SELECT `users`.`stutti_id`,`users`.`password`, `users`.`name` FROM `users` WHERE `users`.`id` = ?";
    //     $stmt = $this->conn->prepare($query);

    //     $stmt->bindValue(1,$loginId,PDO::PARAM_INT);
    //     $stmt->execute();
    //     $ary = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $ary;
    // }

    // 〇マイページユーザー表示
    // myPage.php
    function getUserById() {
        $query = "SELECT `users`.`id`, `users`.`mail_address`, `users`.`stutti_id`, `users`.`password`, `users`.`name`, `users`.`avatar`, `users`.`created_at`, `users`.`updated_at` 
        FROM `users` 
        WHERE `users`.`id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$this->id,PDO::PARAM_INT);
        try {
            if ($stmt->execute()) {
                $ary = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($ary) {
                    return $ary;
                }
            }
            return false;         
        } catch (PDOException $e) {
            error_log("getUserById:" .$e->getMessage());
            return false;
        }
        
    }

    // 〇ファイル保存用
    // userRegister.php (おそらく、Edit でも必要になる?)
    function uploadAvatar($avatar) : int {
        // アップロード処理に失敗
        if ($avatar['error'] !== UPLOAD_ERR_OK) {
            return $avatar['error'];
        }

        // ファイル拡張子チェック
        $ufName = $avatar['name'];
        $ufExtention = strtolower(pathinfo($ufName)['extension']);
        $availableExt = ['gif', 'jpg', 'jpeg', 'png'];
        if (!in_array($ufExtention, $availableExt)) {
            return ERR_CODE_EXTENSION;
        }

        // マイムタイプチェック
        $ufTmpname = $avatar['tmp_name'];
        $ufMimeType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $ufTmpname);
        $availableMType = ['image/gif', 'image/jpg', 'image/jpeg', 'image/png'];
        if (!in_array($ufMimeType, $availableMType)) {
            return ERR_CODE_MIME_TYPE;
        }

        // 一時フォルダからイメージ保存フォルダへファイルを移動
        $uniqueFileName = uniqid().$ufName;
        if (!move_uploaded_file($ufTmpname, DIR_AVATAR . $uniqueFileName)) {
            return ERR_CODE_FAIL_UPLOAD;
        }
        $this->avatar = $uniqueFileName;
        return UPLOAD_OK;
    }
    // 〇グループ詳細画面の作成者確認用
    // 引数で渡された勉強会の作成者かどうかをbooleanで返却
    // groupDetail.php
    public function isOwnerOfGroup($groupId): bool {
        $query = "SELECT `created_by_id` FROM `groups` WHERE `id` = ? ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $groupId);
        try {
            if($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result && $result['created_by_id'] == $this->id) {
                    return true;
                }
            }
            return false;
        }catch (PDOException $e) {
         error_log("isOwnerOfGroup:" .$e->getMessage());
         return false;
        }
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

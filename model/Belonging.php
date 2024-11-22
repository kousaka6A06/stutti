<?php
require_once 'config/Database.php';

class Belonging {
    private $groupId;
    private $memberId;
    private $createdAt;
    private $conn;
    
    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }
    // 勉強会メンバー登録用
    // あらかじめプロパティに設定されたをgroupIdとmemberIdを使って、
    // ユーザーをグループに追加後実行結果の成否をbooleanで返却
    // participate.php
    public function addMember():bool{

        $query = "INSERT INTO `belonging` (`belonging`.`group_id`, `belonging`.`member_id`) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->groupId);
        $stmt->bindParam(2, $this->memberId);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("addMember Error:" . $e->getMessage());
            return false;
        }



    }
    // 勉強会メンバー削除用
    //条件は＆＆でつなぐリムーブメンバー
    public function removeMember():bool{

        $query = "DELETE FROM `belonging` WHERE `belonging`.`group_id` = ? AND `belonging`.`member_id` = ? ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->groupId);
        $stmt->bindParam(2, $this->memberId);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("removeMember Error:" . $e->getMessage());
            return false;
        }

    }



    // ユーザーが勉強会メンバーかどうか確認用
    // 勉強会の参加者かどうかをbooleanで返却
    // groupDetail.php
    public function isMemberOfGroup() {
        $query = "SELECT * 
        FROM `belonging` 
        WHERE `belonging`.`group_id` = ? AND `belonging`.`member_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->groupId);
        $stmt->bindParam(2, $this->memberId);
        try {
            $stmt->execute();
            if($stmt->fetch(PDO::FETCH_ASSOC)){
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("isMemberOfGroup Error:" . $e->getMessage());
            return false;
        }

    }

    // setter
    function setGroupId($groupId) {
        $this->groupId = $groupId;
    }
    function setMemberId($memberId) {
        $this->memberId = $memberId;
    }
    function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    // getter
    function getGroupId():int {
        return $this->groupId;
    }
    function getMemberId():int {
        return $this->memberId;
    }
    function getCreatedAt():string {
        return $this->createdAt;
    }

}

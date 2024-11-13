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
        return $stmt->execute();
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

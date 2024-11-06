<?php
require_once 'config/Database.php';

class GroupMessage {
    private $id;
    private $groupId;
    private $memberId;
    private $content;
    private $createdAt;
    private $conn;
    
    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // 勉強会メッセージ投稿
    function createGroupMessage() {
        $query ="INSERT INTO `group_messages` (`group_messages`.`group_id`,`group_messages`.`member_id`,`group_messages`.`content`) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $this->groupId);
        $stmt->bindValue(2, $this->memberId);
        $stmt->bindValue(3, $this->content);
        return $stmt->execute();
    }

    // 勉強会メッセージ削除

    function deleteGroupMessage() {
        $query = "DELETE FROM `group_messages` WHERE `group_messages`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $this->id);
        return $stmt->execute();
    }

    ///////////////////// メッセージ関連
    // メッセージ表示
    // 昇順表示
    // メッセージを作成したメンバーのIDから、メンバー名を副問い合わせ
    function MessageData() {
        $query = "SELECT `group_messages`.`id`,`group_messages`.`group_id`,(SELECT `users`.`name` FROM `users` WHERE `users`.`id` = `group_messages`.`member_id`) AS `member_name`,`group_messages`.`content`,`group_messages`.`created_at` 
        FROM `group_messages` WHERE `group_messages`.`group_id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1,$this->groupId,PDO::PARAM_INT);
        $stmt->execute();
        $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }

    // setter
    function setId($id) {
        $this->id = $id;
    }
    function setGroupId($groupId) {
        $this->groupId = $groupId;
    }

    function setMemberId($memberId) {
        $this->memberId = $memberId;
    }
    function setContent($content) {
        $this->content = $content;
    }
    function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    // getter
    function getId():int {
        return $this->id;
    }
    function getGroupId():int {
        return $this->groupId;
    }
    function getMemberId():int {
        return $this->memberId;
    }
    function getContent():string {
        return $this->content;
    }
    function getCreatedAt():string {
        return $this->createdAt;
    }

}
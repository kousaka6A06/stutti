<?php

require_once 'config/Database.php';
require_once 'Model/SelectData.php';
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
    function createGroupMessage($group_id, $member_id, $content) {
        $query ="INSERT INTO `group_messages` (`group_messages`.`group_id`,`group_messages`.`member_id`,`group_messages`.`content`) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $group_id);
        $stmt->bindValue(2, $member_id);
        $stmt->bindValue(3, $content);
        $stmt->execute();
    }

    // 勉強会メッセージ削除

    function deleteGroupMessage($id) {
        $query = "DELETE FROM `group_messages` WHERE `group_messages`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $id);
        $stmt->execute();
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
<?php

require_once 'config/Database.php';
require_once 'Model/SelectData.php';
class GroupMessages {
    private $id;
    private $groupId;
    private $memberId;
    private $content;
    private $date;
    private $createdAt;
    private $conn;
    
    private function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // 勉強会メッセージ投稿
    function createGroupMessages($group_id, $member_id, $content) {
        $query ="INSERT INTO `group_messages` (`group_messages`.`group_id`,`group_messages`.`member_id`,`group_messages`.`content`) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $group_id);
        $stmt->bindValue(2, $member_id);
        $stmt->bindValue(3, $content);
        $stmt->execute();
    }

    // 勉強会メッセージ削除

    function deleteGroupMessages($id) {
        $query = "DELETE FROM `group_messages` WHERE `group_messages`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

}
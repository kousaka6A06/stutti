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

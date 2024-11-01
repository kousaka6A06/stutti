<?php
require_once 'config/DbManager.php';
require_once 'Model/SelectData.php';
class Group {
    private $id;
    private $name;
    private $date;
    private $time;
    private $location;
    private $numPeople;
    private $content;
    private $createdById;
    private $tuttiId;
    private $deleteFlag;
    private $createdAt;
    private $updatedAt;
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // 勉強会登録
    function createGroup($name, $date, $time, $location, $numPeople, $content, $createdById, $tuttiId) {
        $query = "INSERT INTO `groups` (`groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content`,`groups`.`created_by_id`,`groups.`tutti_id`) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $date);
        $stmt->bindValue(3, $time);
        $stmt->bindValue(4, $location);
        $stmt->bindValue(5, $numPeople);
        $stmt->bindValue(6, $content);
        $stmt->bindValue(7, $createdById);
        $stmt->bindValue(8, $tuttiId);
        $stmt->execute();
    }

    // 勉強会情報更新
    function updateGroup($date, $time, $location, $numPeople, $content) {
        $query = "UPDATE `groups` SET `groups`.`date` = ?, `groups`.`time` = ?, `groups`.`location` = ?, `groups`.`num_people` = ?, `groups`.`content` = ? WHERE `groups`.`id` = ?";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(1, $date);
        $stmt->bindValue(2, $time);
        $stmt->bindValue(3, $location);
        $stmt->bindValue(4, $numPeople);
        $stmt->bindValue(5, $content);
        $stmt->execute();

    }

    // 勉強会論理削除
    // 論理削除 UPDATE を利用
    function deleteGroup($id) {
        $query = "UPDATE `groups` SET `groups`.`delete_flag` = 1 WHERE `groups`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    // setter
    function setId($id) {
        $this->id = $id;
    }
    function setName($name) {
        $this->name = $name;
    }
    function setDate($date) {
        $this->date = $date;
    }
    function setTime($time) {
        $this->time = $time;
    }
    function setLocation($location) {
        $this->location= $location;
    }
    function setNumPeople($numPeople) {
        $this->numPeople = $numPeople;
    }
    function setContent($content) {
        $this->content = $content;
    }
    function setCreatedById($createdById) {
        $this->createdById = $createdById;
    }
    function setTuttiId($tuttiId) {
        $this->tuttiId = $tuttiId;
    }
    function setDeleteFlag($deleteFlag) {
        $this->deleteFlag = $deleteFlag;
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
    function getName():string {
        return $this->name;
    }
    function getDate():string {
        return $this->date;
    }
    function getLocation():string {
        return $this->location;
    }
    function getNumPeople():int {
        return $this->numPeople;
    }
    function getContent():string {
        return $this->content;
    }
    function getCreatedById():int {
        return $this->createdById;
    }
    function getTuttiId():int {
        return $this->tuttiId;
    }
    function getDeleteFlag():bool {
        return $this->deleteFlag;
    }
    function getCreatedAt():string {
        return $this->createdAt;
    }
    function getUpdatedAt():string {
        return $this->updatedAt;
    }

}
<?php
require_once 'config/DbManager.php';
require_once 'Model/SelectData.php';
class Groups {
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

    private function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // 勉強会登録
    function createGroups($name, $date, $time, $location, $num_people, $content, $created_by_id, $tutti_id) {
        $query = "INSERT INTO `groups` (`groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content`,`groups`.`created_by_id`,`groups.`tutti_id`) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $date);
        $stmt->bindValue(3, $time);
        $stmt->bindValue(4, $location);
        $stmt->bindValue(5, $num_people);
        $stmt->bindValue(6, $content);
        $stmt->bindValue(7, $created_by_id);
        $stmt->bindValue(8, $tutti_id);
        $stmt->execute();
    }

    // 勉強会情報更新
    function updateGroups($date, $time, $location, $num_people, $content) {
        $query = "UPDATE `groups` SET `groups`.`date` = ?, `groups`.`time` = ?, `groups`.`location` = ?, `groups`.`num_people` = ?, `groups`.`content` = ? WHERE `groups`.`id` = ?";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(1, $date);
        $stmt->bindValue(2, $time);
        $stmt->bindValue(3, $location);
        $stmt->bindValue(4, $num_people);
        $stmt->bindValue(5, $content);
        $stmt->execute();

    }

    // 勉強会論理削除
    // 論理削除 UPDATE を利用
    function deleteGroups($id) {
        $query = "UPDATE `groups` SET `groups`.`delete_flag` = 1 WHERE `groups`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $id);
        $stmt->execute();
    }


}
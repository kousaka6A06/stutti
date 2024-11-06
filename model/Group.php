<?php
require_once 'config/Database.php';

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
    function createGroup() {
        $query = "INSERT INTO `groups` 
        (`groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content`,`groups`.`created_by_id`,`groups`.`tutti_id`) 
        VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $this->name);
        $stmt->bindValue(2, $this->date);
        $stmt->bindValue(3, $this->time);
        $stmt->bindValue(4, $this->location);
        $stmt->bindValue(5, $this->numPeople);
        $stmt->bindValue(6, $this->content);
        $stmt->bindValue(7, $this->createdById);
        $stmt->bindValue(8, $this->tuttiId);
        return $stmt->execute();
    }

    // 勉強会情報更新
    function updateGroup() {
        $query = "UPDATE `groups` SET `groups`.`date` = ?, `groups`.`time` = ?, `groups`.`location` = ?, `groups`.`num_people` = ?, `groups`.`content` = ? WHERE `groups`.`id` = ?";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(1, $this->date);
        $stmt->bindValue(2, $this->time);
        $stmt->bindValue(3, $this->location);
        $stmt->bindValue(4, $this->numPeople);
        $stmt->bindValue(5, $this->content);
        $stmt->bindValue(6, $this->id); 

        return $stmt->execute();
    }

    // 勉強会論理削除
    // 論理削除 UPDATE を利用
    function deleteGroup() {
        $query = "UPDATE `groups` SET `groups`.`delete_flag` = 1 WHERE `groups`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $this->id);
        return $stmt->execute();
    }


    // 勉強会の最新の5件を表示する(サムネ)
    function groupNew() {
        $now = date('YY-mm-dd');
        $query = "SELECT `groups`.`name`, `groups`.`date`, `groups`.`time`, `groups`.`location`, `groups`.`num_people`, `groups`.`content` 
                FROM `groups` WHERE `groups`.`delete_flag` = 0 AND `groups`.`date` >= {$now} ORDER BY `groups`.`id` DESC LIMIT 5";
        $stmt = $this->conn->prepare($query);
        
        $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }

    // 勉強会詳細画面表示用
    // 各勉強会サムネのリンクにPOSTで、`groups`.`id` を送ってもらう
    // POST に `groups`.`id` を持ってもらって画面遷移するので、ページとして変数を持っているからそれを引数として宣言してもらう
    // 作成者IDから、memberテーブルより作成者名を副問い合わせ
    function GroupInfo() {
        $now = date('YY-mm-dd');
        $query = "SELECT `groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content`,(SELECT `users`.`name` FROM`users` WHERE `users`.`id` = `groups`.`created_by_id`) AS `user_name` 
        FROM `groups` WHERE `delete_flag` = 0 AND `groups`.`date` >= {$now} AND `groups`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1,$this->id,PDO::PARAM_INT);
        $stmt->execute();
        $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }


    // マイページに表示させる参加している勉強会(サムネ・昇順)
    // group_member テーブルにてユーザーIDで抽出した
    function myPageAttendGroup() {
        $now = date('YY-mm-dd');
        $query = "SELECT `groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content` 
                FROM `groups` 
                WHERE `groups`.`delete_flag` = 0 AND `groups`.`date` >= {$now} AND `groups`.`id` IN (SELECT `belonging`.`group_id` FROM `belonging` WHERE `belonging`.`member_id` = ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1,$this->id,PDO::PARAM_INT);
        $stmt->execute();
        $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }

    // マイページに表示させる自身で作成した勉強会(サムネ・昇順)
    function myPageCreatedGroup() {
        $now = date('YY-mm-dd');
        $query = "SELECT `groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content` FROM `groups` WHERE `delete_flag` = 0 AND `groups`.`date` >= {$now} AND `groups`.`created_by_id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1,$this->id,PDO::PARAM_INT);
        $stmt->execute();
        $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }

    // tutti ごとの最新の勉強会表示(サムネ)
    function tuttiGroup() {
        $now = date('YY-mm-dd');
        $query = "SELECT `groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content`,`groups`.`tutti_id` 
                FROM `groups` WHERE `groups`.`delete_flag` = 0 AND `groups`.`date` >= {$now} ORDER BY `groups`.`id` DESC";
        $stmt = $this->conn->query($query);

        $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
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
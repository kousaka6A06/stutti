<?php
require_once 'config/Database.php';

class TuttiComment {
    private $id;
    private $name;
    private $content;
    private $tuttiId;
    private $createdAt;
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // tutti コメント投稿
    function createTuttiComment() {
        if($this->name){
            $query ="INSERT INTO `tutti_comments` (`tutti_comments`.`name`,`tutti_comments`.`content`,`tutti_comments`.`tutti_id`) VALUES(?,?,?)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(1, $this->name);
            $stmt->bindValue(2, $this->content);
            $stmt->bindValue(3, $this->tuttiId);
        } else {
            $query ="INSERT INTO `tutti_comments` (`tutti_comments`.`content`,`tutti_comments`.`tutti_id`) VALUES(?,?)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(1, $this->content);
            $stmt->bindValue(2, $this->tuttiId);
        }

        return $stmt->execute();
    }

    ///////////////////// tutti コメント関連
    // コメント表示
    // 昇順表示
    function CommentData() {
        $query = "SELECT `tutti_comments`.`id`,`tutti_comments`.`name`,`tutti_comments`.`content`, `tutti_comments`.`tutti_id`, `tutti_comments`.`created_at`
        FROM `tutti_comments` WHERE `tutti_comments`.`tutti_id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1,$this->tuttiId,PDO::PARAM_INT);
        $stmt->execute();
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
    function setContent($content) {
        $this->content = $content;
    }
    function setTuttiId($tuttiId) {
        $this->tuttiId = $tuttiId;
    }
    function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    // getter
    function getId():int {
        return $this->id;
    }
    function getName():string {
        return $this->name;
    }
    function getContent():string {
        return $this->content;
    }
    function getTuttiId():int {
        return $this->tuttiId;
    }
    function getCreatedAt():string {
        return $this->createdAt;
    }


}
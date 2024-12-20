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

    // 〇tutti 詳細画面コメント投稿
    // $this->name の有無によって条件分岐させ、デフォルト名が入るよう処理
    // (これがないと、空文字かNULLになる)
    // commentPost.php
    function createTuttiComment() {
    try {
        if($this->name){
            $query ="INSERT INTO `tutti_comments` (`tutti_comments`.`name`, `tutti_comments`.`content`, `tutti_comments`.`tutti_id`) VALUES(?, ?, ?)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(1, $this->name);
            $stmt->bindValue(2, $this->content);
            $stmt->bindValue(3, $this->tuttiId);
        } else {
            $query ="INSERT INTO `tutti_comments` (`tutti_comments`.`content`, `tutti_comments`.`tutti_id`) VALUES(?, ?)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(1, $this->content);
            $stmt->bindValue(2, $this->tuttiId);
        }
        $stmt->execute();
        return true;
    } catch  (PDOException $e) {
        error_log("createTuttiComment Error:" . $e->getMessage());
        return false;
    }

    }

    // 〇tutti 詳細画面コメント表示
    // 昇順表示・全件返却
    // 詳細画面に入っているので、tutti_id からの名称返却はせず
    // tutti.php
    function getTuttiCommentsByTuttiId() {
        $query = "SELECT `tutti_comments`.`id`, `tutti_comments`.`name`, `tutti_comments`.`content`, `tutti_comments`.`tutti_id`, `tutti_comments`.`created_at`
        FROM `tutti_comments` 
        WHERE `tutti_comments`.`tutti_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$this->tuttiId,PDO::PARAM_INT);
        try {
            $stmt->execute();
            $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $ary;
        } catch (PDOException $e) {
            error_log("getTuttiCommentsByTuttiId Error:" . $e->getMessage());
            return false;
        } 

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
<?php

require_once 'config/Database.php';
require_once 'Model/SelectData.php';
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
    function createTuttiComment($name, $content, $tuttiId) {
        $query ="INSERT INTO `tutti_comments` (`tutti_comments`.`name`,`tutti_comments.content`,`tutti_comments.tutti_id`) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $content);
        $stmt->bindValue(3, $tuttiId);
        $stmt->execute();
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
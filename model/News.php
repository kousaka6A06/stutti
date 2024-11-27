<?php
require_once 'config/Database.php';

class News {
    private $id;
    private $content;
    private $url;
    private $tuttiId;
    private $createdAt;
    private $conn;
    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // tuttiId で全件を戻す
    // tutti.php
    public function getNewsByTuttiId() {
        $query = "SELECT * FROM `news` WHERE `tutti_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$this->tuttiId);
        try {
            $stmt->execute();
            $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $ary;
        } catch (PDOException $e) {
            error_log("deleteGroup:" . $e->getMessage());
            return false;
        }
    }


    // setter
    function setId($id) {
        $this->id = $id;
    }

    function setContent($content) {
        $this->content = $content;
    }
    function setUrl($url) {
        $this->url = $url;
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
    function getContent():string {
        return $this->content;
    }
    function getUrl():string {
        return $this->url;
    }
    function getTuttiId():int {
        return $this->tuttiId;
    }
    function getCreatedAt():string {
        return $this->createdAt;
    }
}
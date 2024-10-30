<?php

require_once 'config/Database.php';
require_once 'Model/SelectData.php';
class TuttiComment {
    private $id;
    private $name;
    private $content;
    private $date;
    private $tuttiId;
    private $createdAt;
    private $conn;

    private function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // tutti コメント投稿
    function createTuttiComments($name, $content, $tutti_id) {
        $query ="INSERT INTO `tutti_comments` (`tutti_comments`.`name`,`tutti_comments.content`,`tutti_comments.tutti_id`) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $content);
        $stmt->bindValue(3, $tutti_id);
        $stmt->execute();
    }
}
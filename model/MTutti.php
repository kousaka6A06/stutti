<?php
require_once 'config/Database.php';

class MTutti {
    private $id;
    private $name;
    private $about;
    private $color;
    private $conn;
   
    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    //////////////////// tutti 表示関連
    // tutti の表示内容を取得する
    function tutti() {
        $query = "SELECT * FROM `m_tutti`";
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
    function setAbout($about) {
        $this->about = $about;
    }
    function setColor($color) {
        $this->color = $color;
    }

    // getter
    function getId():int {
        return $this->id;
    }
    function getName():string {
        return $this->name;
    }
    function getAbout():string {
        return $this->about;
    }
    function getColor():string {
        return $this->color;
    }


}
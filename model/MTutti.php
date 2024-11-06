<?php
require_once 'config/Database.php';

class MTutti {
    private $id;
    private $name;
    private $about;
    private $color;
    private $conn;
   
    // public function __construct() {
    //     $this->conn = Database::getInstance()->getConnection();
    // }
    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
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
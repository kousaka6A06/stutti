<?php

require_once 'config/Database.php';
require_once 'Model/SelectData.php';
class MTutti {
    private $id;
    private $name;
    private $about;
    private $color;
    private $conn;
   
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
    function getId($id):int {
        return $id;
    }
    function getName($name):string {
        return $name;
    }
    function getAbout($about):string {
        return $about;
    }
    function getColor($color):string {
        return $color;
    }

}
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

    // 〇トップページ表示用
    // m_tutti(tutti マスター)の内容を全件取得して返却
    // index.php
    function getAllTutti() {
        $query = "SELECT * 
        FROM `m_tutti`";
        try {
            $stmt = $this->conn->query($query);
            $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $ary;
        } catch (PDOException $e) {
            error_log("getAllTutti Error:" . $e->getMessage());
            return false;
        }

    }

    // 〇tutti 詳細画面表示用
    // あらかじめプロパティに設定(setId($tuttiID))されたtuttiID($this->id)を使って、tuttiを検索して返却
    // tutti.php
    function getTuttiById() {
        $query = "SELECT * 
        FROM `m_tutti` 
        WHERE `m_tutti`.`id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$this->id,PDO::PARAM_INT);
        try {
            $stmt->execute();
            $ary = $stmt->fetch(PDO::FETCH_ASSOC);
            return $ary;
        } catch (PDOException $e) {
            error_log("getTuttiById Error:" . $e->getMessage());
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
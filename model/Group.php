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

    // 〇勉強会登録
    // groupEdit.php
    function createGroup() {
        $query = "INSERT INTO `groups` 
        (`groups`.`name`, `groups`.`date`, `groups`.`time`, `groups`.`location`, `groups`.`num_people`, `groups`.`content`, `groups`.`created_by_id`, `groups`.`tutti_id`) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $this->name);
        $stmt->bindValue(2, $this->date);
        $stmt->bindValue(3, $this->time);
        $stmt->bindValue(4, $this->location);
        $stmt->bindValue(5, $this->numPeople);
        $stmt->bindValue(6, $this->content);
        $stmt->bindValue(7, $this->createdById);
        $stmt->bindValue(8, $this->tuttiId);

        // 最新の採番を id のプロパティに設定
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    // 〇勉強会情報更新
    // あらかじめプロパティに設定された勉強会情報で、Groupsレコードを修正
    // groupEdit.php
    function updateGroup() {
        $query = "UPDATE `groups` 
        SET `groups`.`date` = ?, `groups`.`time` = ?, `groups`.`location` = ?, `groups`.`num_people` = ?, `groups`.`content` = ? 
        WHERE `groups`.`id` = ?";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(1, $this->date);
        $stmt->bindValue(2, $this->time);
        $stmt->bindValue(3, $this->location);
        $stmt->bindValue(4, $this->numPeople);
        $stmt->bindValue(5, $this->content);
        $stmt->bindValue(6, $this->id); 

        return $stmt->execute();
    }

    // 〇勉強会論理削除
    // 論理削除 UPDATE を利用
    // groupDelete.php
    function deleteGroup() {
        $query = "UPDATE `groups` SET `groups`.`delete_flag` = 1 WHERE `groups`.`id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $this->id);
        return $stmt->execute();
    }

    // 〇トップページ表示用
    // 無作為に勉強会の最新表示を5件返却
    // 降順
    // index.php
    function getNewGroups() {
        $now = date('Y-m-d');
        $query = "SELECT `groups`.`id`, `groups`.`name`, `groups`.`date`, `groups`.`time`, `groups`.`location`, `groups`.`num_people`, `groups`.`content` 
                FROM `groups` WHERE `groups`.`delete_flag` = 0 AND `groups`.`date` >= {$now} 
                ORDER BY `groups`.`id` DESC LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }

    // 〇勉強会一覧表示用
    // 勉強会を tutti 毎に最新「5件」 tuttiId をキーにして、Groupの配列を値に持たせる。
    // groupList.php
    function getAllTuttiGroups() {
        $now = date('Y-m-d');
        $q = $this->conn->query("SELECT * FROM `m_tutti`");
        $ary = [];
        $key = [];
        $value = [];
        while($tutti = $q->fetch(PDO::FETCH_ASSOC)) {
            $query = "SELECT `groups`.`id`, `groups`.`name`, `groups`.`date`, `groups`.`time`, `groups`.`location`, `groups`.`num_people`, `groups`.`content`, 
            (SELECT `m_tutti`.`name` FROM `m_tutti` WHERE `m_tutti`.`id` = `groups`.`tutti_id`) AS `tutti_name` 
            FROM `groups` 
            WHERE `tutti_id` = {$tutti['id']} AND `groups`.`delete_flag` = 0 AND `groups`.`date` >= {$now} ORDER BY `groups`.`id` DESC LIMIT 5";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $tuttiGroups = ['id'=>$tutti['id'],'name'=>$tutti['name'],'groups'=>$groups];
            array_push($key,$tutti['id']);
            array_push($value,$tuttiGroups);
            // $ary = array_merge($ary,array($tutti['id']=>$groups));
            // $ary = ('id' =>$tutti['id'], 'name'=>$tutti['name'], 'groups'=> $groups);
        }
        $ary= array_combine($key,$value);
        return $ary;
    }

    // 〇勉強会詳細画面表示用
    // あらかじめプロパティに設定された$groupId = groups.id を使って、特定の単一勉強会を検索して返却
    // 作成者IDから、memberテーブルより作成者名を副問い合わせ
    // user_name として扱う
    // tutti_id から、m_tuttiテーブルより tutti 名を副問い合わせ
    // tutti_name として扱う
    // groupDetail.php
    function getGroupById() {
        $now = date('Y-m-d');
        $query = "SELECT `groups`.`id`, `groups`.`name`, `groups`.`date`, `groups`.`time`, `groups`.`location`, `groups`.`num_people`, `groups`.`content`, 
        (SELECT `users`.`name` FROM`users` WHERE `users`.`id` = `groups`.`created_by_id`) AS `user_name`, 
        (SELECT `m_tutti`.`name` FROM `m_tutti` WHERE `m_tutti`.`id` = `groups`.`tutti_id`) AS `tutti_name`,
        `groups`.`created_at`,
        `groups`.`updated_at` 
        FROM `groups` 
        WHERE `delete_flag` = 0 AND `groups`.`date` >= {$now} AND `groups`.`id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$this->id,PDO::PARAM_INT);
        $stmt->execute();
        $ary = $stmt->fetch(PDO::FETCH_CLASS);
        return $ary;
    }


    // 〇マイページに表示させる参加している勉強会(サムネ・昇順)
    // 引数(User->id)にて
    // 副問い合わせした belonging テーブルより検索、IN にて対象複数レコードを取得
    // 昇順・全件返却
    // tutti_id から、m_tuttiテーブルより tutti 名を副問い合わせ
    // tutti_name として扱う
    // myPage.php
    function getGroupsByMemberId($userId) {
        $now = date('Y-m-d');
        $query = "SELECT `groups`.`id`, `groups`.`name`, `groups`.`date`, `groups`.`time`, `groups`.`location`, `groups`.`num_people`, `groups`.`content`, `groups`.`created_by_id`, 
                (SELECT `m_tutti`.`name` FROM `m_tutti` WHERE `m_tutti`.`id` = `groups`.`tutti_id`) AS `tutti_name` 
                FROM `groups` 
                WHERE `groups`.`delete_flag` = 0 AND `groups`.`date` >= {$now} AND `groups`.`id` IN (SELECT `belonging`.`group_id` FROM `belonging` WHERE `belonging`.`member_id` = ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$userId,PDO::PARAM_INT);
        $stmt->execute();
        $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }

    // 〇マイページに表示させる自身で作成した勉強会(サムネ・昇順)
    // 引数(User->id)にて
    // created_by_id を検索
    // 昇順・全件返却
    // tutti_id から、m_tuttiテーブルより tutti 名を副問い合わせ
    // tutti_name として扱う
    // myPage.php
    function getGroupsByOwnerId($userId) {
        $now = date('Y-m-d');
        $query = "SELECT `groups`.`id`, `groups`.`name`, `groups`.`date`, `groups`.`time`, `groups`.`location`, `groups`.`num_people`, `groups`.`content`, `groups`.`created_by_id`, 
                (SELECT `m_tutti`.`name` FROM `m_tutti` WHERE `m_tutti`.`id` = `groups`.`tutti_id`) AS `tutti_name` 
                FROM `groups` 
                WHERE `delete_flag` = 0 AND `groups`.`date` >= {$now} AND `groups`.`created_by_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$userId,PDO::PARAM_INT);
        $stmt->execute();
        $ary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }

    // 〇tutti 詳細ページにて利用
    // tutti ごとの最新の勉強会表示
    // (引数で渡された←プロパティにあるので不採用)
    // あらかじめプロパティで設定されたtuttiIDを使って、tuttiに所属するGroupを検索して返却
    // 降順・全件返却
    // tutti_id から、m_tuttiテーブルより tutti 名を副問い合わせ
    // tutti_name として扱う
    // tutti.php
    function getGroupsByTuttiId() {
        $now = date('Y-m-d');
        $query = "SELECT `groups`.`id`, `groups`.`name`, `groups`.`date`, `groups`.`time`, `groups`.`location`, `groups`.`num_people`, `groups`.`content`, `groups`.`created_by_id`, 
                (SELECT `m_tutti`.`name` FROM `m_tutti` WHERE `m_tutti`.`id` = `groups`.`tutti_id`) AS `tutti_name` 
                FROM `groups` 
                WHERE `groups`.`tutti_id` = ? AND `groups`.`delete_flag` = 0 AND `groups`.`date` >= {$now} ORDER BY `groups`.`id` DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->tuttiId, PDO::PARAM_INT);
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
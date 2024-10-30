<?php
class InserttData {

    private $dc;
    private $stmt;

    function __construct() {
        $this->dc = getDb();
    }


    // 勉強会登録
    // function createGroups($name, $date, $time, $location, $num_people, $content, $created_by_id, $tutti_id) {
    //     $this->stmt = $this->dc->prepare("INSERT INTO `groups` (`groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content`,`groups`.`created_by_id`,`groups.`tutti_id`) VALUES(?,?,?,?,?,?,?,?)");
    //     $this->stmt->bindValue(1, $name);
    //     $this->stmt->bindValue(2, $date);
    //     $this->stmt->bindValue(3, $time);
    //     $this->stmt->bindValue(4, $location);
    //     $this->stmt->bindValue(5, $num_people);
    //     $this->stmt->bindValue(6, $content);
    //     $this->stmt->bindValue(7, $created_by_id);
    //     $this->stmt->bindValue(8, $tutti_id);
    //     $this->stmt->execute();
    // }
    
    // tutti コメント投稿
    // function createTuttiComments($name, $content, $tutti_id) {
    //     $this->stmt = $this->dc->prepare("INSERT INTO `tutti_comments` (`tutti_comments`.`name`,`tutti_comments.content`,`tutti_comments.tutti_id`) VALUES(?,?,?)");
    //     $this->stmt->bindValue(1, $name);
    //     $this->stmt->bindValue(2, $content);
    //     $this->stmt->bindValue(3, $tutti_id);
    //     $this->stmt->execute();
    // }

    // 勉強会メッセージ投稿
    // function createGroupMessages($group_id, $member_id, $content) {
    //     $this->stmt = $this->dc->prepare("INSERT INTO `group_messages` (`group_messages`.`group_id`,`group_messages`.`member_id`,`group_messages`.`content`) VALUES(?,?,?)");
    //     $this->stmt->bindValue(1, $group_id);
    //     $this->stmt->bindValue(2, $member_id);
    //     $this->stmt->bindValue(3, $content);
    //     $this->stmt->execute();
    // }
}

class UpdateData {
    private $dc;
    private $stmt;

    function __construct() {
        $this->dc = getDb();
    }
    // 会員情報更新
    // function updateUsers($mail_address, $stuttiId, $password, $name, $avater, $id) {
    //     $this->stmt = $this->dc->prepare("UPDATE `users` SET `users`.`mail_address` = ?, `users`.`stutti_id` = ?, `users`.`password` = ?, `users`.`name` = ?, `users`.`avater` = ? WHERE `users`.`id` = ?");
    //     $this->stmt->bindValue(1, $mail_address);
    //     $this->stmt->bindValue(2, $stuttiId);
    //     $this->stmt->bindValue(3, $password);
    //     $this->stmt->bindValue(4, $name);
    //     $this->stmt->bindValue(5, $avater);
    //     $this->stmt->bindValue(6, $id);
    //     $this->stmt->execute();
    // }
    // 会員情報削除
    // 論理削除 UPDATE を利用
    // function deleteUsers($id) {
    //     $this->stmt = $this->dc->prepare("UPDATE `users` SET `users`.`delete_flag` = 1  WHERE `users`.`id` = ?");
    //     $this->stmt->bindValue(1, $id);
    //     $this->stmt->execute();
    // }
    // 勉強会情報更新
    // function updateGroups($date, $time, $location, $num_people, $content) {
    //     $this->stmt = $this->dc->prepare("UPDATE `groups` SET `groups`.`date` = ?, `groups`.`time` = ?, `groups`.`location` = ?, `groups`.`num_people` = ?, `groups`.`content` = ? WHERE `groups`.`id` = ?");
    //     $this->stmt->bindValue(1, $date);
    //     $this->stmt->bindValue(2, $time);
    //     $this->stmt->bindValue(3, $location);
    //     $this->stmt->bindValue(4, $num_people);
    //     $this->stmt->bindValue(5, $content);
    //     $this->stmt->execute();
    // }
    // 勉強会論理削除
    // function deleteGroups($id) {
    //     $this->stmt = $this->dc->prepare("UPDATE `groups` SET `groups`.`delete_flag` = 1 WHERE `groups`.`id` = ?");
    //     $this->stmt->bindValue(1, $id);
    //     $this->stmt->execute();
    // }
}

// 物理削除クラス
class DeleteData {
    private $dc;
    private $stmt;

    function __construct() {
        $this->dc = getDb();
    }

    // 勉強会メッセージ削除
    // function deleteGroupMessages($id) {
    //     $this->stmt = $this->dc->prepare("DELETE FROM `group_messages` WHERE `group_messages`.`id` = ?");
    //     $this->stmt->bindValue(1, $id);
    //     $this->stmt->execute();
    // }
}
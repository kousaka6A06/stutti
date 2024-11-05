<?php

class SelectData {

    private $dc;
    private $stmt;

    function __construct() {
        $this->dc = getDb();
    }
//////////////////// tutti 表示関連
    // tutti の表示内容を取得する
    function tutti() {
        $sql = "SELECT * FROM `m_tutti`";
        $result = $this->dc->query($sql);
        $ary = $result->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }

//////////////////// ユーザー関連
    // ログイン
    function LoginUser($loginId) {
        $sql = "SELECT `users`.`stutti_id`,`users`.`password`, `users`.`name` FROM `users` WHERE `users`.`id` = ?";
        $this->stmt = $this->dc->prepare($sql);
        $this->stmt->bindValue(1,$loginId,PDO::PARAM_INT);
        $this->stmt->execute();
        $ary = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $ary;
    }
    // マイページ表示
    function userInfo($userId) {
        $sql = "SELECT `users`.`id`, `users`.`mail_address`, `users`.`stutti_id`,`users`.`name`, `users`.`avater`, `users`.`created_at` FROM `users` WHERE `users`.`id` = ?";
        $this->stmt = $this->dc->prepare($sql);
        $this->stmt->bindValue(1,$userId,PDO::PARAM_INT);
        $this->stmt->execute();
        $ary = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }

///////////////////// 勉強会関連
    // 削除フラグがなく、本日より新しい日付のもの

    // 勉強会の最新の5件を表示する(サムネ)
    function groupNew() {
        $now = date('YY-mm-dd');
        $sql = "SELECT `groups`.`name`, `groups`.`date`, `groups`.`time`, `groups`.`location`, `groups`.`num_people`, `groups`.`content` 
                FROM `groups` WHERE `groups`.`delete_flag` = 0 AND `groups`.`date` >= {$now} ORDER BY `groups`.`date` DESC LIMIT 5";
        $result = $this->dc->query($sql);
        $ary = $result->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }
    // tutti ごとの最新の勉強会表示(サムネ)
    function tuttiGroup() {
        $now = date('YY-mm-dd');
        $sql = "SELECT `groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content`,`groups`.`tutti_id` 
                FROM `groups` WHERE `groups`.`delete_flag` = 0 AND `groups`.`date` >= {$now} ORDER BY DESC";
        $result = $this->dc->query($sql);
        $ary = $result->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }
    // マイページに表示させる参加している勉強会(サムネ・昇順)
    // group_member テーブルにてユーザーIDで抽出した
    function myPageAttendGroup($memberId) {
        $now = date('YY-mm-dd');
        $sql = "SELECT `groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content` 
                FROM `groups` 
                WHERE `groups`.`delete_flag` = 0 AND `groups`.`date` >= {$now} AND `groups`.`id` IN (SELECT `belonging`.`group_id` FROM `belonging` WHERE `belonging`.`member_id` = {$memberId})";
        $this->stmt = $this->dc->prepare($sql);
        $this->stmt->bindValue(1,$memberId,PDO::PARAM_INT);
        $this->stmt->execute();
        $ary = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }
    // マイページに表示させる自身で作成した勉強会(サムネ・昇順)
    function myPageCreatedGroup($memberId) {
        $now = date('YY-mm-dd');
        $sql = "SELECT `groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content` FROM `groups` WHERE `delete_flag` = 0 AND `groups`.`date` >= {$now} AND `groups`.`created_by_id` = ?";
        $this->stmt = $this->dc->prepare($sql);
        $this->stmt->bindValue(1,$memberId,PDO::PARAM_INT);
        $this->stmt->execute();
        $ary = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }
    // 勉強会詳細画面表示用
    // 各勉強会サムネのリンクにPOSTで、`groups`.`id` を送ってもらう
    // POST に `groups`.`id` を持ってもらって画面遷移するので、ページとして変数を持っているからそれを引数として宣言してもらう
    // 作成者IDから、memberテーブルより作成者名を副問い合わせ
    function GroupInfo($groupId) {
        $now = date('YY-mm-dd');
        $sql = "SELECT `groups`.`name`,`groups`.`date`,`groups`.`time`,`groups`.`location`,`groups`.`num_people`,`groups`.`content`,(SELECT `member`.`user_name` FROM`member` WHERE `member`.`id` = `groups`.`created_by_id`) AS `user_name` 
        FROM `groups` WHERE `delete_flag` = 0 AND `groups`.`date` >= {$now} AND `groups`.`id` = ?";
        $this->stmt = $this->dc->prepare($sql);
        $this->stmt->bindValue(1,$groupId,PDO::PARAM_INT);
        $this->stmt->execute();
        $ary = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }


///////////////////// tutti コメント関連
    // コメント表示
    // 昇順表示
    function CommentData($tuttiId) {
        $sql = "SELECT `tutti_comments`.`id`,`tutti_comments`.`name`,`tutti_comments`.`content`,`tutti_comments`.`date`,`tutti_comments`.`tutti_id` 
        FROM `tutti_comments` WHERE `tutti_comments`.`tutti_id` = ?";
        $this->stmt = $this->dc->prepare($sql);
        $this->stmt->bindValue(1,$tuttiId,PDO::PARAM_INT);
        $this->stmt->execute();
        $ary = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }
///////////////////// メッセージ関連
    // メッセージ表示
    // 昇順表示
    // メッセージを作成したメンバーのIDから、メンバー名を副問い合わせ
    function MessageData($groupId) {
        $sql = "SELECT `group_messages`.`id`,`group_messages`.`group_id`,(SELECT `users`.`name` FROM `users` WHERE `users`.`id` = `group_messages`.`member_id`) AS `member_name`,`group_messages`.`content`,`group_messages`.`created_at` 
        FROM `group_messages` WHERE `group_messages`.`group_id` = ?";
        $this->stmt = $this->dc->prepare($sql);
        $this->stmt->bindValue(1,$groupId,PDO::PARAM_INT);
        $this->stmt->execute();
        $ary = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ary;
    }



}
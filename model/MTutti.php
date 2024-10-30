<?php
class MTutti {
    private $id;
    private $name;
    private $about;
   
    function __construct() {
        $this->dc = getDb();
    }
    public function getId($id) {
        return $id;
    }

    public function getName($name) {
        return $name;
    }

    public function getAbout($about) {
        return $about;
    }


}
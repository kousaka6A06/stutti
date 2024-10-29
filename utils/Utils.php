<?php

class Utils {
    public static function loadView($ttl, $vw) {
        $v_title = $ttl;
        $v_includeFile = $vw;
        require_once 'view/template.php';
    }
}
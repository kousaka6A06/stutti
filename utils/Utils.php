<?php

class Utils {
    public static function loadView($ttl, $vw) {
        $v_title = $ttl;
        $v_includeFile = $vw;
        require_once 'view/template.php';
    }

    public static function e(string $str, string $charset = 'UTF-8'): string {
        return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, $charset, false);
    }
}
<?php

class Session {
    public static function  is_user($login) {
        return (!empty($_SESSION[$login]) && ($_SESSION['login'] == $login));
    }
}

?>
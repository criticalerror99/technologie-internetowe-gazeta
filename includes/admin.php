<?php
    session_start();

    define('admin_login', 'admin');
    define('admin_passwd', 'admin4321');

    function isLogged() {
        if(isset($_SESSION["admin_log"])) {
            if($_SESSION["admin_log"] == admin_login && $_SESSION["admin_pass"] == admin_passwd) return true;
        }
        return false;
    }

?>
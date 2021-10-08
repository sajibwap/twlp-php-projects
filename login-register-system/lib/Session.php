<?php 


class Session{
    /**
     * Initialize the session
     */
    public static function init(){
        if (session_status()==PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function set($key,$value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }else{
            return false;
        }
    }

    public static function destroy(){
        session_destroy();
        session_unset();
        header("Location: login.php");
    }

    public static function checkSession(){
        if (self::get('login')==true) {
            header("Location: index.php");
        }
    }

    public static function checkLogin(){
        if (self::get('login')==false) {
            header("Location: login.php");
        }
    }
}

<?php
class Security {

    /*public function __construct(){
        session_start();
    }*/

    public static function isSessionOpen(){
        session_start();
        if(isset($_SESSION["id"])):
            return true;
        else:
            return false;
        endif;
    }

    public static function openSession($id, $type) {
        session_start();
        $_SESSION["id"] = $id;
        $_SESSION["type"] = $type;
    }

    public static function closeSession($data) {
        session_start();
        session_destroy();
        View::redirect("showFormLogin", $data);
    }

    public static function getId() {
        session_start();
        if (isset($_SESSION["id"])) {
            return $_SESSION["id"];
        } else {
            return -1;
        }
    }

    public static function getType() {
        session_start();
        if (isset($_SESSION["type"])) {
            return $_SESSION["type"];
        } else {
            return -1;
        }
    }

}
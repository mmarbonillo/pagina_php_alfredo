
<?php
class DBInfo {

    private static $DBHOST = "localhost";
    private static $DBUSER = "root";
    private static $DBPASSWD = "";
    private static $DBNAME = "web";

    public static function getDbHost(){
        return $DBHOST;
    }

    public static function getDbUser() {
        return $DBUSER;
    }

    public static function getDbPassword() {
        return $DBPASSWD;
    }

    public static function getDbName() {
        return $DBNAME;
    }
}
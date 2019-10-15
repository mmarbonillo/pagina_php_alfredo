
<?php
class DBInfo {

    private static $DBHOST = "localhost";
    private static $DBUSER = "root";
    private static $DBPASSWD = "";
    private static $DBNAME = "web";

    public static function getDbHost(){
        return self::$DBHOST;
    }

    public static function getDbUser() {
        return self::$DBUSER;
    }

    public static function getDbPassword() {
        return self::$DBPASSWD;
    }

    public static function getDbName() {
        return self::$DBNAME;
    }
}
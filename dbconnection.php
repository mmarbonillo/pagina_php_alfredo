<?php
class DBConnector {

    private $conection;

    public function __construct($dbhost, $dbuser, $dbpasswd, $dbname){
        $connection = new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
    }

    public function select($select){
        $result = $connection = query($select);
        $info = array();
        while($tupla = $result->fetch_object()):
            $info[] = $tupla;
        endwhile;
        return $info;
    }

}
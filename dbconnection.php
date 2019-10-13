<?php
class DBConnector {

    private $connection;

    public function __construct($dbhost, $dbuser, $dbpasswd, $dbname){
        $connection = new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
    }

    public function select($select){
        $result = $this->connection->query($select);
        $info = array();
        while($tupla = $result->fetch_object()):
            $info[] = $tupla;
        endwhile;
        return $info;
    }

    public function insertDeleteUpdate($sql){
        $result = $this->connection->query($sql);
        if($this->connection->affected_rows() == 1):
            return true;
        else:
            return false;
        endif;
    }

}
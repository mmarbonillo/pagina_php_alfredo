<?php
class DBConnector {

    private $connection;

    public function __construct($dbhost, $dbuser, $dbpasswd, $dbname){
        $this->connection = new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
    }

    public function select($select){
        $result = $this->connection->query($select);
        $info = array();
        if ($result != false && $result->num_rows != 0):
            while($tupla = $result->fetch_object()):
                $info[] = $tupla;
            endwhile;
        endif;
        //View::show("error", $info);
        return $info;
    }

    public function insertDeleteUpdate($sql){
        $result = $this->connection->query($sql);
        if($this->connection->affected_rows == 1):
            return true;
        else:
            return false;
        endif;
    }

}
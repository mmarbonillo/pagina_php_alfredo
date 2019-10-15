<?php
//include ("config.php");
    include_once("./security.php");
    include_once("./dbconnection.php");
    include_once("./dbInfo.php");
    class User {
        private $db;

        public function __construct() {
            //$this->db = new DBConnector("localhost", "root", "", "web");
            $this->db = new DBConnector(DBInfo::getDbHost(), DBInfo::getDbUser(), DBInfo::getDbPassword(), DBInfo::getDbName());
        }

        public function getForUsername($username, $pass) {
            $sql = "SELECT * FROM users WHERE username = '$username' AND passwd = '$pass'";
            //$infor = array();
            $infor = $this->db->select("SELECT * FROM users WHERE username = '$username' AND passwd = '$pass'");
            if (count($infor) != 0) {
                Security::openSession($infor[0]->id, $infor[0]->tipo);
                $userOk = true;
            } else {
                $userOk = false;
            }
            //View::show("error", Security::getType());
            return $userOk;
        }

        public function getAllFromOneUser($id) {
            $sql = "SELECT * FROM users WHERE id=$id";
            $result = $this->db->select($sql);
            if(sizeof($result) != 0):
                return $result;
            else:
                return null;
            endif;
        }

        public function getAll() {
            $sql = "SELECT * FROM users";
            $result = $this->db->select($sql);
            return $result;
        }

        public function insert($data) {
            $sql = "INSERT INTO users VALUES (NULL, '".$data['username']."', '".$data['name']."', '".$data['surnames']."', '".$data['passwd']."', '".$data['email']."', ".$data['type'].")";
            $consulta = $this->db->insertDeleteUpdate($sql);
            return $consulta;

        }

        public function delete($id) {
            $sql ="DELETE FROM users WHERE id='$id'";
            $consulta = $this->db->insertDeleteUpdate($sql);
            return $consulta;
        }

        public function update($data) {
            if(isset($data["type"])):
                $sql = "UPDATE users SET username = '".$data['username']."', nombre = '".$data['nombre']."', 
                apellidos = '".$data['apellidos']."',passwd = '".$data['passwd']."', email = '".$data['email']."', tipo = '".$data['type']."' WHERE id = '".$data['id']."'";
            else:
                $sql = "UPDATE users SET username = '".$data['username']."', nombre = '".$data['nombre']."', 
                apellidos = '".$data['apellidos']."',passwd = '".$data['passwd']."', email = '".$data['email']."' WHERE id = '".$data['id']."'";
            endif;
            $consulta = $this->db->insertDeleteUpdate($sql);
            return $consulta;
        }
    }
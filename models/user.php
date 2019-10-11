<?php
//include ("config.php");
    include_once("./security.php");
    include_once("./dbconnection.php");
    class User {
        private $db;

        public function __construct() {
            $this->db = new DBConnector(getenv("DBHOST"), getenv("DBUSER"), getenv("DBPASSWORD"), getenv("DBNAME"));
        }

        public function getForUsername($username, $pass) {
            $sql = "SELECT * FROM users WHERE username = '$username' AND passwd = '$pass'";
            $info = $this->db->select($sql);
            if (sizeOf($info) != 0) {
                Security::openSession($info[0]["id"], $info[0]["tipo"]);
                $userOk = true;
            } else {
                $userOk = false;
            }
            return $userOk;
        }

        public function getAllFromOneUser($id) {
            $sql = "SELECT * FROM users WHERE id=$id";
            $result = $this->db->select($sql);
            if(sizeof($result) != 0):
                return $userData;
            endif;
        }

        public function getAll() {
            $sql = "SELECT * FROM users";
            $result = $this->db->select($sql);
            return $result;
        }

        public function insert($data) {
            $sql = "INSERT INTO users VALUES (NULL, '".$data['username']."', '".$data['name']."', '".$data['surnames']."', '".$data['passwd']."', '".$data['email']."', ".$data['type'].")";
            $this->db->query($sql);
            echo ($sql);
            if ($this->db->affected_rows == 1) {
                return true;
            } else {
                return false;
            }

        }

        public function delete($id) {
            $this->db->query("DELETE FROM users WHERE id='$id'");
            if ($this->db->affected_rows == 1) {
                return true;
            } else {
                return false;
            }
        }

        public function update($data) {
            //UPDATE users SET tipo = 0, username = 'maria' WHERE id = 1;
            if(isset($data["type"])):
                $sql = "UPDATE users SET username = '".$data['username']."', nombre = '".$data['nombre']."', 
                apellidos = '".$data['apellidos']."',passwd = '".$data['passwd']."', email = '".$data['email']."', tipo = '".$data['type']."' WHERE id = '".$data['id']."'";
            else:
                $sql = "UPDATE users SET username = '".$data['username']."', nombre = '".$data['nombre']."', 
                apellidos = '".$data['apellidos']."',passwd = '".$data['passwd']."', email = '".$data['email']."' WHERE id = '".$data['id']."'";
            endif;
            $this->db->query($sql);
            if ($this->db->affected_rows == 1):
                return true;
            else:
                return false;
            endif;
        }
    }
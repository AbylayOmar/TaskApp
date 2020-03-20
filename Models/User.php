<?php 

class User {
    public function set_login($login = null) {
        if ($login != null) {
            $this -> login = $login;
        }
    }

    public function get_login() {
        return $this -> login;
    }

    public function save() {
        include_once('libs/Connection.php');
        $sql = "INSERT INTO users values(".$this->login.", ".$this->password.");";
        mysqli_query($conn, $sql);
    }
}
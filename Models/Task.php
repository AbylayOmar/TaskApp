<?php

class Task {
    public function __construct($uname, $mail, $text)
    {
        $this -> username = $uname;
        $this -> email = $mail;
        $this -> body = $text;
        $this -> status = false;
        $this -> is_edited = false;
    }

    public function save() {
        include_once('libs/Connection.php');
        $sql = "INSERT INTO tasks (username, email, body, status, is_edited) VALUES('".$this->username."', '".$this->email."', '".$this->body."', 0, 0);";
        mysqli_query($conn, $sql);
    }
}
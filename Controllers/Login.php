<?php 
require_once('libs/Controller.php');

class Login extends Controller {
    public function index() {
        session_start();
        $this->view->render("Views/login/index.php");
    }

    public function logout() {
        session_start();
        $_SESSION["status"] = " ";
        $_SESSION["loggedin"] = false;
        header("Location: http://localhost:8000/Home?page=1");
    }
    public function auth($args = null) {
        session_start();
        include('libs/Connection.php');
        $login = $args['username'];
        $password = $args['password'];
        $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password';";
        $result = mysqli_query($conn, $sql);
        $nr = mysqli_num_rows($result);
        error_log($sql);
        error_log($nr);
        error_log($_SESSION["status"]);
        $this->view->status = $nr;
        if ($nr == 0) {
            if ($login != null || $password != null)
                $_SESSION["status"] = "Incorrect creditionals";
            else
                $_SESSION["status"] = "Shouldnt be empty";
            $_SESSION["loggedin"] = false;
        } else {
            $_SESSION["loggedin"] = true;
            $_SESSION["status"] = 'logged';
            header("Location: http://localhost:8000/Home?page=1");
        }
    }

    public function done($args = null) {
        session_start();
        include('libs/Connection.php');
        $id = $args['id'];
        $sql = "UPDATE tasks SET status = 1 WHERE id = '$id';";
        $result = mysqli_query($conn, $sql);
        header("Location: http://localhost:8000/Home?page=1");
    }

    public function edit($args = null) {
        session_start();
        if ($_SESSION["status"] == 'logged') {
        include('libs/Connection.php');
        foreach($args as $key => $val) {
            $id = $key;
            $body = $val;
            error_log($id, $body);
            $sql = "SELECT body FROM tasks WHERE id = '$id';";
            $result = mysqli_query($conn, $sql);
            $rows = array();
            while($row = mysqli_fetch_row($result))
                if ($row[0] != $body) {
                    $sql = "UPDATE tasks SET is_edited = 1, body = '$body' WHERE id = '$id';";
                    $result = mysqli_query($conn, $sql);
                }
            
        }
        }
    }
}
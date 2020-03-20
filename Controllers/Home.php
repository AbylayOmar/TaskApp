<?php
require_once('libs/Controller.php');
require_once('Models/Task.php');

class Home extends Controller {
    public function index($args = null) {
        session_start();
        include('libs/Connection.php');
        $sql = "SELECT * FROM tasks;";
        $result = mysqli_query($conn, $sql);
        $page = $args['page'];
        error_log($args['page']);
        $nr = mysqli_num_rows($result);
        $items_per_page = 3;
        $total_pages = ceil($nr/$items_per_page);
        $offset = ($page - 1) * $items_per_page;

        $order = $args['order'];
        if ($order != null) {
            $ad = $args['dir'];
            $sql = "SELECT * FROM tasks ORDER BY $order $ad LIMIT $items_per_page OFFSET $offset;";
        } else
            $sql = "SELECT * FROM tasks LIMIT $items_per_page OFFSET $offset;";

        error_log($sql);
        $result = mysqli_query($conn, $sql);
            $rows = array();
            while($row = mysqli_fetch_assoc($result))
                $rows[] = $row;
            $this -> view -> tasks = $rows;
            $this -> view -> tp = $total_pages;
            $this -> view -> page = $page;
        
        $this -> view -> render('Views/home/index.php');
    }

    public function add($args = null) {
        $task = new Task($args['username'], $args['email'], $args['body']);
        $task -> save();
        header('Location: http://localhost:8000/Home?page=1&success=1');
    }
}
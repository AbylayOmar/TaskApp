<?php
require_once 'libs/View.php';

class Controller {
    public function __construct() {
        $this->view = new View();
    }
}
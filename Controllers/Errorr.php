<?php
require_once('libs/Controller.php');

class Errorr extends Controller {
    public function indexAction() {
        $this -> view -> message = "The controller doesnt exist";
        $this -> view -> render('Views/error/index.php');
    }
}
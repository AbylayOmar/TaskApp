<?php
class Bootstrap {
    public function __construct(){
        //router
        $tokens = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));

        //dispatcher
        $x = explode('?', rtrim($tokens[1], '?'));
        $controllerName = ucfirst($x[0]);
        if (count($x) > 1)
            $xatrs = explode('=', rtrim($x[1], '='));
        else
            $xatrs = ['-1'];
        if ($controllerName == 'Home') {
            if ($xatrs[0] == 'sstatus') {
                require_once('Controllers/Home.php');
                $methodName = 'index';
                $controller = new Home();
                $controller -> $methodName(['page' => 1, 'order' => 'status', 'dir' => $xatrs[1]]);
            } else if ($xatrs[0] == 'susername') {
                require_once('Controllers/Home.php');
                $methodName = 'index';
                $controller = new Home();
                $controller -> $methodName(['page' => 1, 'order' => 'username', 'dir' => $xatrs[1]]);
            } else if ($xatrs[0] == 'semail') {
                require_once('Controllers/Home.php');
                $methodName = 'index';
                $controller = new Home();
                $controller -> $methodName(['page' => 1, 'order' => 'email', 'dir' => $xatrs[1]]);
            } else if ($xatrs[0] == 'page') {
                error_log("index");
                error_log($xatrs[1]);
                require_once('Controllers/Home.php');
                $methodName = 'index';
                $controller = new Home();
                $controller -> $methodName(['page' => $xatrs[1], 'order' => null]);
            } else if (file_exists('Controllers/'.$controllerName.'.php')) {
                require_once('Controllers/'.$controllerName.'.php');
                $controller = new $controllerName;
                $args = null;
                if (isset($tokens[2]) && $tokens[1] != 'Login') {
                    $atr = explode('?', rtrim($tokens[2], '?'));
                    $methodName = $atr[0];
                    $atrs = explode('&', rtrim($atr[1], '&'));
                    $args = array();
                    foreach ($atrs as $item) {
                        $vals = explode('=', rtrim($item, '='));
                        $args[urldecode($vals[0])] = urldecode($vals[1]);
                    }
                } else {
                    $methodName = 'index';
                }
                
                $controller -> $methodName($args);
            } else {
                $controllerName = 'Errorr';
                require_once('Controllers/'.$controllerName.'.php');
                $controller = new $controllerName;
                $controller -> indexAction();
            }
        } else if ($controllerName == 'Login') {
            require_once('Controllers/'.$controllerName.'.php');
            $controller = new $controllerName;
            error_log("ABRAKDATA");
            error_log($controllerName);
            $args = null;
            if (isset($tokens[2]) && $tokens[2] != 'index') {
                $atr = explode('?', rtrim($tokens[2], '?'));
                $methodName = $atr[0];
                $atrs = explode('&', rtrim($atr[1], '&'));
                $args = array();
                foreach ($atrs as $item) {
                    $vals = explode('=', rtrim($item, '='));
                    $args[urldecode($vals[0])] = urldecode($vals[1]);
                }
            } else {
                $methodName = 'index';
            }
            
            $controller -> $methodName($args);
        }
    }
}

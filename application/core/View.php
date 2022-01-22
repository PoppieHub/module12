<?php

namespace application\core;

class View {

    public $path;
    public $layout = 'default';
    public $route;

    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public static function modifyPath($str) {
        $str =  str_replace( "Controller","", $str);
        return mb_strtolower($str);
    }

    public function render($hand, $value = []) {

        $path = 'application/templates/';

        if (file_exists($path.$this->modifyPath($this->path).'.php')) {
            ob_start();
            require $path.$this->modifyPath($this->path).'.php';
            $content = ob_get_clean();
            require $path.'/layout/'.$this->layout.'.php';
        } else {
            self::displayError(null,404);
        }
    }

    public function redirect($url) {
        header('location: '.$url);
        exit();
    }

    public static function displayError($text,$code) {
        require 'application/templates/layout/error.php';
        exit();
    }
}
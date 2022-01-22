<?php

namespace application\core;

use application\core\View;

/**
 * @property mixed|void $model
 */

class Controller {

    public $view, $route;

    public function __construct($route) {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name) {
        $name = View::modifyPath($name);
        $path = 'application\models\\'.ucfirst($name);

        if (class_exists($path)) {
            return new $path;
        }
    }
}
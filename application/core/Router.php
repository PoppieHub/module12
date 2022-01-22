<?php

namespace application\core;

use application\core\View;

class Router {

    protected $routes = [];
    protected $params = [];

    public function __construct() {
        $this->loadRoutes();
    }

    /*
     * Загрузка переданных маршрутов из application\core\routes.php
     */
    public function loadRoutes() {
        $arr = require 'application/config/routes.php';

        foreach ($arr as $key => $value) {
            $this->addRoute($key, $value);
        }
    }

    /*
     * Добавление маршрута
     * Позволяют перехватить строку, которая начинается и заканчивается строкой из $route.
     */
    public function addRoute($route, $params) {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    /*
    * Проверка маршрута
    * Получает основной путь без полного url (Текущий маршрут).
    * Если найдены совпадения текущего маршрута и маршрута из $routes.php через регулярку, то запишет в текущую переменную и вернет true.
    */
    public function checkRoute() {
        $url = $_SERVER['REQUEST_URI'];
        $url = trim($url, '/');

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $checked)) {
                $this->params = $params;

                return true;
            }
        }

        return false;
    }

    /*
    * Перенаправление маршрута
    */
    public function redirectToRoute() {
        if ($this->checkRoute()) {
            $routeController = ucfirst($this->params['controller']);
            $path = 'application\controllers\\'.$routeController;

            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::displayError('Не найден метод: '.$action.'() в классе '.'"'.$path.'".', 404);
                }
            } else {
                View::displayError("Не найден класс: '$path'", 404);
            }
        } else {
            View::displayError(null,404);
        }
    }
}
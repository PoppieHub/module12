<?php

namespace application\controllers;

use application\core\AbstractController;

class HomeController extends AbstractController {

    public function indexAction() {
        //$this->view->path = 'home/main';
        //$this->view->layout = 'custom';

        $forRender = parent::renderDefult();

        $this->view->render($forRender);

    }

}
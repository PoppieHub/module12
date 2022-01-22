<?php

namespace application\core;


abstract class AbstractController extends Controller {

    public function renderDefult() {

        return [
            'title' => 'Модуль 12',
        ];
    }
}
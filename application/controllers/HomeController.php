<?php

namespace application\controllers;

use application\core\AbstractController;

class HomeController extends AbstractController {

    public function indexAction() {

        $personsModel = $this->loadModel('Persons');

        $persons = $personsModel->getPersons();
        //dd($persons);

        //dd($personsModel->getPartsFromFullName($persons[1]['fullname']));
        $partsFullName = $personsModel->getPartsFromFullName($persons[0]['fullname']);

        //dd($personsModel->getFullNameFromParts($partsFullName));
        $fullName = $personsModel->getFullNameFromParts($partsFullName);

        //dd($personsModel->getShortName($fullName));
        $shortName = $personsModel->getShortName($fullName);

        dd($personsModel->getGenderFromName($fullName));
        $genderFromName = $personsModel->getGenderFromName($fullName);

        $forRender = parent::renderDefult();

        $this->view->render($forRender);

    }

}
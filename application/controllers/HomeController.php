<?php

namespace application\controllers;

use application\core\AbstractController;

class HomeController extends AbstractController {

    public function indexAction() {

        $personsModel = $this->loadModel('Persons');

        $persons = $personsModel->getPersons();

        foreach ($persons as $key => $person) {

            $persons[$key]['partsFullName'] = $personsModel->getPartsFromFullName($person['fullname']);
            $persons[$key]['fullNameFromParts'] = $personsModel->getFullNameFromParts($persons[$key]['partsFullName']);
            $persons[$key]['shortName'] = $personsModel->getShortName($persons[$key]['fullNameFromParts']);
            $persons[$key]['genderFromName'] = $personsModel->getGenderFromName($persons[$key]['fullNameFromParts']);

            $persons[$key]['perfectPartner'] = $personsModel->getPerfectPartner(
                $persons[$key]['partsFullName']['surname'],
                $persons[$key]['partsFullName']['name'],
                $persons[$key]['partsFullName']['patronymic'],
                $persons
            );
        }

        $genderDescription = $personsModel->getGenderDescription($persons);

        $randomPerson = $personsModel->getRandomPerson($persons, 'fullname');
        $randomPersonParts = $personsModel->getPartsFromFullName($randomPerson);

        $perfectPartner = $personsModel->getPerfectPartner(
            $randomPersonParts['surname'],
            $randomPersonParts['name'],
            $randomPersonParts['patronymic'],
            $persons
        );

        $forRender = parent::renderDefult();
        $forRender['persons'] = $persons;
        $forRender['genderDescription'] = $genderDescription;
        $forRender['randomPerfectPartner'] = $perfectPartner;

        $this->view->render($forRender);

    }

}
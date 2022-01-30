<?php

namespace application\models;

use application\core\Model;

class Persons extends Model {

    /**
     * @var array|string[]
     */
    public static array $genders = [
        'maleGender' => 'мужской пол',
        'femaleGender' => 'женский пол',
        'indeterminateGender' => 'неопределенный пол'
    ];

    /**
     * @return bool|array
     */
    public function getPersons(): bool|array {
        return $this->db->haveMany(
            '
                    SELECT p.fullname, pr.name as profession
                    FROM persons p 
                    LEFT JOIN profession pr ON p.profession_id = pr.id 
                    ORDER BY p.fullname ASC'
        );
    }

    /**
     * @param int $min
     * @param int $max
     * @return int|float
     */
    function randomFloat(int $min = 0, int $max = 1): int|float {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

    /**
     * @param array $person
     * @param string $returnKey
     * @param int $min
     * @return mixed
     */
    public function getRandomPerson(array $person, string $returnKey = '', int $min = 0): mixed {
        $randomKey =  rand($min, count($person) - 1);

        if (!empty($returnKey)) {
            return $person[$randomKey][$returnKey];
        }
        return $person[$randomKey];
    }

    /**
     * @param string $fioStr
     * @return bool|array
     */
    public function getPartsFromFullName(string $fioStr = ''): bool|array {

        if (!empty($fioStr)) {
            $fioStr = mb_convert_case($fioStr, MB_CASE_TITLE, "UTF-8");
            $fioArr = explode(' ', $fioStr, 3);
            return [
                'surname' => ($fioArr[0]) ? $fioArr[0] : '',
                'name' => ($fioArr[1]) ? $fioArr[1] : '',
                'patronymic' => ($fioArr[2]) ? $fioArr[2] : '',
            ];
        }

        return false;
    }

    /**
     * @param array $fioArr
     * @return bool|string
     */
    public function getFullNameFromParts(array $fioArr = []): bool|string {

        if (!empty($fioArr)) {
            $fioStr = implode(' ', $fioArr);

            return  mb_convert_case($fioStr, MB_CASE_TITLE, "UTF-8");
        }

        return false;
    }

    /**
     * @param string $fioStr
     * @return bool|string
     */
    public function getShortName(string $fioStr = ''): bool|string {

        if (!empty($fioStr)) {
            $fioArr = $this->getPartsFromFullName($fioStr);
            $fioArr['surname'] = mb_substr($fioArr['surname'], 0, 1);

            return $fioArr['name'].' '.$fioArr['surname'].'.';
        }

        return false;
    }

    /**
     * @param string $fioStr
     * @return bool|string
     */
    public function getGenderFromName(string $fioStr = ''): bool|string {
        $genderCount = 0;

        if (!empty($fioStr)) {
            $fioArr = $this->getPartsFromFullName($fioStr);

            if (mb_substr($fioArr['surname'], -1, 1) === 'в' ||
                mb_substr($fioArr['name'], -1, 1) === 'й' ||
                mb_substr($fioArr['name'], -1, 1) === 'н' ||
                mb_substr($fioArr['patronymic'], -2, 2) === 'ич'
            ) $genderCount++;

            elseif (mb_substr($fioArr['surname'], -2, 2) === 'ва' ||
                    mb_substr($fioArr['name'], -1, 1) === 'а' ||
                    mb_substr($fioArr['patronymic'], -3, 3) === 'вна'
            ) $genderCount--;

            if ($genderCount > 0) {
                return self::$genders['maleGender'];
            } elseif ($genderCount < 0) {
                return self::$genders['femaleGender'];
            } else {
                return self::$genders['indeterminateGender'];
            }
        }

        return false;
    }

    /**
     * @param array $persons
     * @return bool|array
     */
    public function getGenderDescription(array $persons = []): bool|array {
        $totalLength = count($persons);
        $listGender = [];
        $result = [];

        if ($persons) {
            foreach ($persons as $person) {
                if ($person['fullname']) {
                    array_push($listGender, $this->getGenderFromName($person['fullname']));
                }
            }

            foreach (self::$genders as $key => $genderValue) {
                $listArr = array_filter($listGender, fn($gender) => $gender === $genderValue);
                $result[$key] = round(count($listArr) / $totalLength * 100,0); // без этой конструкции вернет bool
            }

            return $result;
        }

        return false;
    }

    /**
     * @param string $surname
     * @param string $name
     * @param string $patronymic
     * @param array $persons
     * @return bool|array
     */
    public function getPerfectPartner(string $surname, string $name, string $patronymic, array $persons): bool|array {

        if ($surname && $name && $patronymic && $persons) {
            $surname = mb_convert_case($surname, MB_CASE_TITLE, "UTF-8");
            $name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
            $patronymic = mb_convert_case($patronymic, MB_CASE_TITLE, "UTF-8");

            $fio = $this->getFullNameFromParts([$surname, $name, $patronymic]);
            $genderCurrent = $this->getGenderFromName($fio);

            do {
                $randomPerson = $this->getRandomPerson($persons, 'fullname');
                $genderRandomPerson = $this->getGenderFromName($randomPerson);
            } while ($genderCurrent === $genderRandomPerson);

            $compatibility = round($this->randomFloat(50, 100), 2);

            return [
                'first_person' => $this->getShortName($fio),
                'first_gender' => $genderCurrent,
                'second_person' => $this->getShortName($randomPerson),
                'second_gender' => $genderRandomPerson,
                'compatibility' => $compatibility.'%'
            ];
        }

        return false;
    }
    
}
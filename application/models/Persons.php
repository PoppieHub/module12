<?php

namespace application\models;

use application\core\Model;

class Persons extends Model {

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
                return 'мужской пол';
            } elseif ($genderCount < 0) {
                return 'женский пол';
            } else {
                return 'неопределенный пол';
            }
        }

        return false;
    }
}
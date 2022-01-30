<div class="container">
    <div class="row">
        <div class="mx-auto col-md-8">
            <h5 class="mt-4">Исходный массив содержит данные:</h5>
            <table class="mt-4 table table-dark table-hover color-style">
                <thead>
                    <tr>
                        <th class="text-center"><small>№</small></th>
                        <th class="text-center">ФИО (полное)</th>
                        <th class="text-center">Профессия</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($hand['persons'] as $key => $person): ?>
                        <tr>
                            <th class="text-center">
                                <small>
                                    <?= $key + 1 ?>
                                </small>
                            </th>
                            <td class="text-center">
                                <?= $person['fullname']; ?>
                            </td>
                            <td class="text-center">
                                <?= $person['profession']; ?>
                            </td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="mx-auto col-md-10">
            <h5 class="mt-4">Разбиение и объединение ФИО</h5>
            <h6 class="mt-4"> Результат выполнения функции: <i>getPartsFromFullname</i> и <i>getFullnameFromParts</i> представлены в виде таблиц.</h6>
            <q><i><b>getPartsFromFullname</b></i> принимает как аргумент одну строку — склеенное ФИО. Возвращает как результат массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronymic’.</q><br>
            <q><i><b>getFullnameFromParts</b></i> принимает как аргумент три строки — фамилию, имя и отчество. Возвращает как результат их же, но склеенные через пробел.</q>
            <h6 class="mt-4 text-center"><b>getPartsFromFullname</b></h6>
            <table class="mt-4 table table-dark table-hover color-style">
                <thead>
                    <tr>
                        <th class="text-center"><small>№</small></th>
                        <th class="text-center">ФИО (входное)</th>
                        <th class="text-center">surname</th>
                        <th class="text-center">name</th>
                        <th class="text-center">patronymic</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($hand['persons'] as $key => $person): ?>
                        <tr>
                            <th class="text-center">
                                <small>
                                    <?= $key + 1 ?>
                                </small>
                            </th>
                            <td class="text-center">
                                <?= $person['fullname']; ?>
                            </td>
                            <? foreach ($person['partsFullName'] as $personName): ?>
                                <td class="text-center">
                                    <?= $personName; ?>
                                </td>
                            <? endforeach; ?>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
            <h6 class="mt-4 text-center"><b>getFullnameFromParts</b></h6>
            <table class="mt-4 table table-dark table-hover color-style">
                <thead>
                <tr>
                    <th class="text-center"><small>№</small></th>
                    <th class="text-center">surname (входное)</th>
                    <th class="text-center">name (входное)</th>
                    <th class="text-center">patronymic (входное)</th>
                    <th class="text-center">результат (склеенное)</th>
                </tr>
                </thead>
                <tbody>
                    <? foreach ($hand['persons'] as $key => $person): ?>
                        <tr>
                            <th class="text-center">
                                <small>
                                    <?= $key + 1 ?>
                                </small>
                            </th>
                            <? foreach ($person['partsFullName'] as $personName): ?>
                                <td class="text-center">
                                    <?= $personName; ?>
                                </td>
                            <? endforeach; ?>
                            <td class="text-center">
                                <?= $person['fullNameFromParts']; ?>
                            </td>

                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="mx-auto col-md-8">
            <h5 class="mt-4">Сокращение ФИО</h5>
            <h6 class="mt-4"> Результат выполнения функции: <i>getShortName</i> представлено в виде таблицы.</h6>
            <q>Разработайте функцию <i><b>getShortName</b></i>, принимающую как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович» и возвращающую строку вида «Иван И.», где сокращается фамилия и отбрасывается отчество. Для разбиения строки на составляющие используйте функцию <i><b>getPartsFromFullname</b></i>.</q>
            <table class="mt-4 table table-dark table-hover color-style">
                <thead>
                <tr>
                    <th class="text-center"><small>№</small></th>
                    <th class="text-center">ФИО (getFullNameFromParts)</th>
                    <th class="text-center">Сокращенное (getShortName)</th>
                </tr>
                </thead>
                <tbody>
                    <? foreach ($hand['persons'] as $key => $person): ?>
                        <tr>
                            <th class="text-center">
                                <small>
                                    <?= $key + 1 ?>
                                </small>
                            </th>
                            <td class="text-center">
                                <?= $person['fullNameFromParts']; ?>
                            </td>
                            <td class="text-center">
                                <?= $person['shortName']; ?>
                            </td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="mx-auto col-md-8">
            <h5 class="mt-4">Функция определения пола по ФИО</h5>
            <h6 class="mt-4"> Результат выполнения функции: <i>getGenderFromName</i> представлено в виде таблицы.</h6>
            <q>Разработайте функцию <i><b>getGenderFromName</b></i>, принимающую как аргумент строку, содержащую ФИО (вида «Иванов Иван Иванович»).</q>
            <table class="mt-4 table table-dark table-hover color-style">
                <thead>
                <tr>
                    <th class="text-center"><small>№</small></th>
                    <th class="text-center">ФИО (переданное с getFullNameFromParts)</th>
                    <th class="text-center">Пол (getGenderFromName)</th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($hand['persons'] as $key => $person): ?>
                    <tr>
                        <th class="text-center">
                            <small>
                                <?= $key + 1 ?>
                            </small>
                        </th>
                        <td class="text-center">
                            <?= $person['fullNameFromParts']; ?>
                        </td>
                        <td class="text-center">
                            <?= $person['genderFromName']; ?>
                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="mx-auto col-md-8">
            <h5 class="mt-4">Определение возрастного-полового состава</h5>
            <h6 class="mt-4"> Результат выполнения функции: <i>getGenderDescription </i> представлено в виде диаграммы и таблички.</h6>
            <q>Напишите функцию <i><b>getGenderDescription</b></i> для определения полового состава аудитории. Как аргумент в функцию передается исходный массив.</q><br>
            <q>Используйте для решения функцию фильтрации элементов массива, функцию подсчета элементов массива, функцию <i><b>getGenderFromName</b></i>, округление.</q>
            <div class="mt-4 chart-diogram">
                <canvas class="diogram" width="700" height="400"></canvas>
            </div>
            <div class="mt-4 table-gender">
                <h6>Половой состав аудитории:</h6>
                <hr>
                <ul class="list-group row">
                    <li>
                        <span>Мужчины - <?= $hand['genderDescription']['maleGender'].'%' ?></span>
                    </li>
                    <li>
                        <span>Женщины - <?= $hand['genderDescription']['femaleGender'].'%' ?></span>
                    </li>
                    <li>
                        <span>Не удалось определить - <?= $hand['genderDescription']['indeterminateGender'].'%' ?></span>
                    </li>
                </ul>
        </div>
    </div>
</div>
    <div class="row">
        <div class="mx-auto col-md-10">
            <h5 class="mx-auto mt-4">Идеальный подбор пары</h5>
            <h6 class="mx-auto mt-4">Результат выполнения функции: <i>getPerfectPartner</i> представлено в виде таблицы и колонки.</h6>
            <div class="description mx-auto mt-4">
                <q>Разработайте функцию <i><b>getPerfectPartner </b></i>, принимающий три аргумента в функцию передаются строки с фамилией, именем и отчеством (именно в этом порядке). При этом регистр может быть любым: ИВАНОВ ИВАН ИВАНОВИЧ, ИваНов Иван иванович.</q><br>
                <q>Как четвертый аргумент в функцию передается исходный массив.</q><br>
                <q>Процент совместимости «Идеально на ...» — случайное число от 50% до 100% с точностью два знака после запятой.</q>
            </div>
            <table class="mt-4 table table-dark table-hover color-style">
                <thead>
                <tr>
                    <th class="text-center"><small>№</small></th>
                    <th class="text-center">Партнер 1</th>
                    <th class="text-center">Пол партнера 1</th>
                    <th class="text-center">Партнер 2</th>
                    <th class="text-center">Пол партнера 2</th>
                    <th class="text-center">Совместимость</th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($hand['persons'] as $key => $person): ?>
                    <tr>
                        <th class="text-center">
                            <small>
                                <?= $key + 1 ?>
                            </small>
                        </th>
                        <? foreach ($person['perfectPartner'] as $value): ?>
                            <td class="text-center">
                                <?= $value; ?>
                            </td>
                        <? endforeach; ?>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
            <div class="mt-4 table-partner mb-4">
                <h6>Случайная пара:</h6>
                <hr>
                <ul class="list-group row">
                    <li>
                        <span><?= $hand['randomPerfectPartner']['first_person'].' + '.$hand['randomPerfectPartner']['second_person'] ?> =</span>
                    </li>
                    <li>
                        <span>♡ Идеально на <?= $hand['randomPerfectPartner']['compatibility'] ?> ♡</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

<script>
    const diogram = document.querySelector(".diogram");
    const tags = ["Мужчины (в процентах)", "Женщины (в процентах)", "Не удалось определить (в процентах)"]
    const dataTraffic = {
        data: [
            <?= $hand['genderDescription']['maleGender'] ?>,
            <?= $hand['genderDescription']['femaleGender'] ?>,
            <?= $hand['genderDescription']['indeterminateGender'] ?>
        ],
        backgroundColor: [
            'rgba(163,221,203,0.2)',
            'rgba(232,233,161,0.2)',
            'rgba(230,181,102,0.2)',
        ],
        borderColor: [
            'rgba(163,221,203,1)',
            'rgba(232,233,161,1)',
            'rgba(230,181,102,1)',
        ],
        borderWidth: 2,
    };
    new Chart(diogram, {
        type: 'pie',
        data: {
            labels: tags,
            datasets: [
                dataTraffic,
            ]
        },
    });
</script>
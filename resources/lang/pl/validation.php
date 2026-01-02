<?php
return [
    'gender' => [
        'required' => 'Proszę wybrać płeć.',
        'in' => 'Wybrana płeć jest nieprawidłowa.',
    ],
    'age' => [
        'required' => 'Proszę wybrać wiek z podanego zakresu.',
    ],
    'tags' => [
        'required' => 'Musisz podać przynajmniej jedno zainteresowanie.',
        'array'    => 'Zainteresowania muszą być przesłane w poprawnym formacie.',
        'min'      => 'Wymagane jest przynajmniej :min zainteresowanie.',
    ],
    'accept_terms' => [
        'accepted' => 'Musisz zaakceptować regulamin.',
    ],
];

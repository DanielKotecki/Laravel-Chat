<?php
return [
    'gender' => [
        'required' => 'Bitte wähle dein Geschlecht aus.',
        'in' => 'Das ausgewählte Geschlecht ist ungültig.',
    ],
    'age' => [
        'required' => 'Bitte wähle dein Alter aus dem Bereich aus.',
    ],
    'tags' => [
        'required' => 'Du musst mindestens ein Tag angeben.',
        'array'    => 'Tags müssen in einem gültigen Format übermittelt werden.',
        'min'      => 'Mindestens :min Tag ist erforderlich.',
    ],
    'accept_terms' => [
        'accepted' => 'Du musst die Nutzungsbedingungen akzeptieren.',
    ],
];

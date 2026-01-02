<?php
return [
    'gender' => [
        'required' => 'Please select your gender.',
        'in' => 'The selected gender is invalid.',
    ],
    'age' => [
        'required' => 'Please select your age from the range.',
    ],
    'tags' => [
        'required' => 'You must provide at least one tag.',
        'array'    => 'Tags must be submitted in a valid format.',
        'min'      => 'At least :min tag is required.',
    ],
    'accept_terms' => [
        'accepted' => 'You must accept the terms of service.',
    ],
];

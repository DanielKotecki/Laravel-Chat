<?php
return [
    'gender' => [
        'required' => 'Veuillez sélectionner votre genre.',
        'in' => 'Le genre sélectionné est invalide.',
    ],
    'age' => [
        'required' => 'Veuillez sélectionner votre âge dans la plage.',
    ],
    'tags' => [
        'required' => 'Vous devez fournir au moins un tag.',
        'array'    => 'Les tags doivent être soumis dans un format valide.',
        'min'      => 'Au moins :min tag est requis.',
    ],
    'accept_terms' => [
        'accepted' => 'Vous devez accepter les conditions d’utilisation.',
    ],
];

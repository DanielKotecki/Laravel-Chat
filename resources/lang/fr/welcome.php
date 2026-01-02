<?php
return [
    'header' => [
        'h1' => 'Bienvenue sur Chat Incognito',
        'p' => 'Fournissez des informations vous concernant et vous pourrez commencer à discuter.',
    ],
    'form' => [
        'gender' => [
            'gender_label' => 'Votre genre',
            'gender_options' => [
                'male' => 'Homme',
                'female' => 'Femme',
                'other' => 'Autre/Préférer ne pas dire'
            ]
        ],
        'age' => [
            'age_label' => 'Âge',
        ],
        'nickname' => [
            'nickname_label' => 'Pseudo (facultatif)',
            'nickname_placeholder'=>'Laisser vide → Anonyme...'
        ],
        'tags' => [
            'tags_label' => 'Intérêts (max 5)',
            'tags_p' => 'Sélectionnez les sujets dont vous souhaitez parler.'
        ],
        'buttons' => [
            'submit' => 'Entrer dans le chat',
            'reset' => 'Réinitialiser le formulaire',
        ],
        'accept_terms' => 'J’accepte les',
        'terms_link'   => 'conditions d’utilisation',
    ]
];

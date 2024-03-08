<?php

return [
    'collections' => [
        'create_root' => [
            'label' => 'Créer une collection parent',
        ],
        'create_child' => [
            'label' => 'Créer une collection enfant',
        ],
        'move' => [
            'label' => 'Déplacer la collection',
        ],
        'delete' => [
            'label' => 'Supprimer',
        ],
    ],
    'orders' => [
        'update_status' => [
            'label' => 'Changer le status',
            'wizard' => [
                'step_one' => [
                    'label' => 'Status',
                ],
                'step_two' => [
                    'label' => 'Mailers & Notifications',
                    'no_mailers' => 'Il n\'y a pas de mailers disponible pour ce status.',
                ],
                'step_three' => [
                    'label' => 'Prévisualiser & Enregistrer',
                    'no_mailers' => 'Aucun mailers n\'a été choisi pour la prévisualisation.',
                ],
            ],
            'notification' => [
                'label' => 'Status de la commande mis à jour',
            ],
            'billing_email' => [
                'label' => 'Email facturation',
            ],
            'shipping_email' => [
                'label' => 'Email expédition',
            ],
        ],

    ],
];

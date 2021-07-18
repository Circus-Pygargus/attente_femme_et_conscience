<?php

namespace App\Repository\Traits;

Trait AccompanimentAndFormationTrait
{
    protected function getAccompanimentsAndFormationsLinks () : array
    {
        $title = 'Accompagnements & Formations';
        $categorgies = [];
        $categorgies[] = [
                'name' => 'Les prochains rendez-vous',
                'link' => 'rendez_vous'
        ];

        $categorgies[] = [
            'name' => 'Accompagnements en présentiel',
            'link' => 'presential_accompaniments',
            'links' => [
                [
                    'slug' => '2',
                    'title' => 'à la découverte de mon corps de femme et de ma sensualité'
                ],
                [
                    'slug' => '3',
                    'title' => 'Atelier de Yoni'
                ],
                [
                    'slug' => '4',
                    'title' => 'Cercle de lune'
                ],
                [
                    'slug' => '5',
                    'title' => 'Cercle de paroles'
                ],
                [
                    'slug' => '6',
                    'title' => 'Soins de la matrice'
                ],
                [
                    'slug' => '7',
                    'title' => 'Initiation soins Isis'
                ],
                [
                    'slug' => '8',
                    'title' => 'Reiki Usu'
                ]
            ]
        ];
        $categorgies[] = [
            'name' => 'Formations à distance',
            'link' => 'distance-learning',
            'links' => [
                [
                    'slug' => '9',
                    'title' => 'Mon cercle de lune'
                ],
                [
                    'slug' => '10',
                    'title' => 'Initiation à Isis'
                ]
            ]
        ];
        $categorgies[] = [
            'name' => 'Produits',
            'link' => 'products',
            'links' => [
                [
                    'slug' => '11',
                    'title' => 'Mon bâton de lune'
                ],
                [
                    'slug' => '12',
                    'title' => 'Ma poupée de lune ou Matriochka'
                ]
            ]
        ];

        $links = [
            'title' => $title,
            'categories' => $categorgies
        ];


        return $links;
    }
}

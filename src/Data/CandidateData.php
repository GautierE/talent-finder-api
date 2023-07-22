<?php

namespace App\Data;

class CandidateData
{
    public static function getFrenchFirstNames(): array
    {
        return [
            'Jean',
            'Pierre',
            'Marie',
            'Anne',
            'Michel',
            'Sophie',
            'Luc',
            'Isabelle',
            'François',
            'Catherine',
            'Paul',
            'Julie',
            'Antoine',
            'Valérie',
            'Thierry',
            'Nathalie',
            'Philippe',
            'Caroline',
            'Bruno',
            'Sandrine',
            'Sébastien',
            'Christine',
            'Guillaume',
            'Laurence',
            'Christophe',
            'Valérie',
            'Alexandre',
            'Isabelle',
            'Nicolas',
        ];
    }

    public static function getFrenchLastNames(): array
    {
        return [
            'Dupont',
            'Martin',
            'Dubois',
            'Roux',
            'Lefèvre',
            'Leroy',
            'Fournier',
            'Moreau',
            'Simon',
            'Laurent',
            'Lefort',
            'Petit',
            'Marchand',
            'Girard',
            'Dufour',
            'Barbier',
            'Guerin',
            'Andre',
            'Robert',
            'Richard',
            'Dubois',
            'Lambert',
            'Bonnet',
            'Rousseau',
            'Vincent',
            'Meyer',
            'Blanc',
            'Leroux',
            'David',
        ];
    }

    public static function getCities(): array
    {
        return [
            'Paris',
            'Marseille',
            'Lyon',
            'Toulouse',
            'Nice',
            'Nantes',
            'Montpellier',
            'Bordeaux',
            'Lille',
            'Rennes',
            'Barcelona',
        ];
    }

    public static function getSkillCategories(): array
    {

        return [
            'frontend',
            'backend',
            'mobile',
            'project_management',
            'databases',
            'apis',
            'devops',
            'misc',
            'testing',
        ];
    }

    public static function getSkillCountBoundaries(): array
    {
        return [
            'frontend' => [
                'junior' => [5, 10],
                'intermediate' => [7, 14],
                'senior' => [10, 20],
            ],
            'backend' => [
                'junior' => [5, 9],
                'intermediate' => [7, 12],
                'senior' => [10, 18],
            ],
            'mobile' => [
                'junior' => [0, 2],
                'intermediate' => [0, 3],
                'senior' => [1, 5],
            ],
            'project_management' => [
                'junior' => [0, 2],
                'intermediate' => [1, 3],
                'senior' => [2, 4],
            ],
            'databases' => [
                'junior' => [1, 4],
                'intermediate' => [3, 6],
                'senior' => [3, 7],
            ],
            'apis' => [
                'junior' => [1, 2],
                'intermediate' => [1, 3],
                'senior' => [2, 4],
            ],
            'devops' => [
                'junior' => [5, 10],
                'intermediate' => [8, 14],
                'senior' => [10, 18],
            ],
            'misc' => [
                'junior' => [0, 7],
                'intermediate' => [2, 10],
                'senior' => [4, 13],
            ],
            'testing' => [
                'junior' => [1, 3],
                'intermediate' => [2, 4],
                'senior' => [5, 7],
            ],
        ];
    }
}

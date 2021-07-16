<?php

namespace App\GraphQL\Types;

use App\Models\Covid;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CovidType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Covid',
        'description' => 'Details about covid',
        'model' => Covid::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of the covid',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of covid',
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Short description of the covid',
            ],
            'peopleAffected' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Number of pepole afftected due to covid',
            ],
            'deathCount' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Number of death due to covid',
            ],
            'peopleVaccinated' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Number of people vaccinated',
            ],
            'is_lockdown' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Currently in lockdown or not',
            ],
        ];
    }
}
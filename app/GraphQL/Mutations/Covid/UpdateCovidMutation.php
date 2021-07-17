<?php

namespace App\GraphQL\Mutations\Covid;

use App\Models\Covid;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateCovidMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateCovid',
        'description' => 'Updates a covid'
    ];

    public function type(): Type
    {
        return GraphQL::type('Covid');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' =>  Type::nonNull(Type::int()),
            ],
            'name' => [
                'name' => 'name',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'description' => [
                'name' => 'description',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'peopleAffected' => [
                'name' => 'peopleAffected',
                'type' => Type::nonNull(Type::int()),
            ],
            'deathCount' => [
                'name' => 'deathCount',
                'type' => Type::nonNull(Type::int()),
            ],
            'peopleVaccinated' => [
                'name' => 'peopleVaccinated',
                'type' => Type::nonNull(Type::int()),
            ],
            'is_lockdown' => [
                'name' => 'is_lockdown',
                'type' => Type::nonNull(Type::string()),
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $covid_data = Covid::findOrFail($args['id']);
        $covid_data->fill($args);
        $covid_data->save();

        return $covid_data;
    }
}
<?php
namespace App\GraphQL\Mutations\Covid;

use App\Models\Covid;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteCovidMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteCovid',
        'description' => 'Deletes a covid'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['exists:covids']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $covid_data = Covid::findOrFail($args['id']);

        return  $covid_data->delete() ? true : false;
    }
}
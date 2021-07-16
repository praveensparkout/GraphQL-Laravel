<?php

namespace App\GraphQL\Queries;
use App\Models\Covid;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CovidQuery extends Query
{
    protected $attributes = [
        'name' => 'covid',
    ];

    public function type(): Type
    {
        return GraphQL::type('Covid');
    }

    public function args():array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Covid::findOrFail($args['id']);
    }
}
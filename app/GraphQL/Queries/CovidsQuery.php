<?php

namespace App\GraphQL\Queries;

use App\Models\Covid;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL;
class CovidsQuery extends Query
{
    protected $attributes = [
        'name' => 'covids',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Covid'));
    }

    public function resolve($root, $args)
    {
        return Covid::all();
    }
}

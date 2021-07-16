# GraphQL-Laravel
Learn how to develop GraphQL APIs with Laravel

# Dependencies

1. PHP ">=7.4"
2. Laravel 6.0+

Install Laravel GraphQL library via the composer :
composer require rebing/graphql-laravel

In this project, i/we have used PHP 8.0 and Laravel 8.40. Created a model in the name Covid with migration and seeding.

After the installation, you need to run the following command:
php artisan vendor:publish --provider="Rebing\GraphQL\GraphQLServiceProvider"

This command extracts the graphql.php configuration file from the vendor folder and put it into the config folder. This is a common approach that allows you to get one or more configuration files from a third party package so that you can change it for the needs of your application. You will use the graphql.php file later.

# Creating the GraphQL API Schema

# Creating the Covid Type

Created the GraphQL directory inside the app directory. This directory will contain all the definitions you need for the GraphQL schema of the API. In the app/GraphQL directory, create the Types directory and put in it a file called CovidType.php with the following content:

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

# Creating the GraphQL Queries

Created a Queries directory inside the ./app/GraphQL directory and put there a file called CovidsQuery.php with the following content:

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

The type() method returns the type of the resource returned by the query, expressed as a list of Covid type items. The resolve() method actually returns the list of covids by using the all() method of the Covid model.

In the same way, create a second file in the ./app/GraphQL/Queries directory called CovidQuery.php (note that, this time, covid is singular). In this file, add the following code:

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

# Registering the Schema 

After creating these types and queries, you need to register these items as the GraphQL schema in your API. So, open the graphql.php file (you will find it inside the config directory) and replace the current definition of 'schemas' with the following:

// ./config/graphql.php

// ...
    'schemas' => [
        'default' => [
               'query' => [
                   'covid' => App\GraphQL\Queries\CovidQuery::class,
                'covids' => App\GraphQL\Queries\CovidssQuery::class,
            ]
        ],
    ],
// ...


Here you are saying that the schema of your GraphQL API consists of two queries named covid and covids, mapped to CovidQuery and CovidsQuery classes respectively.

Then, in the same file, replace the current definition of 'types' with the following:

// ./config/graphql.php

// ...
    'types' => [
      'Covid' => App\GraphQL\Types\CovidType::class,
  ],
// ..

This definition maps the type GraphQL Covid to the CovidType class.

Now you are ready to use your GraphQL API. You could test the API by using curl, Postman, or any other HTTP client. 

GraphQL endpoint will be - http://BASE_URL/graphql

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


![image](https://user-images.githubusercontent.com/33898897/125930374-86bec04c-8415-4f6f-96d7-03e0787d7f0b.png)


# Creating the GraphQL Queries

Created a Queries directory inside the ./app/GraphQL directory and put there a file called CovidsQuery.php with the following content:


![image](https://user-images.githubusercontent.com/33898897/125930538-618fd52f-d310-4694-96ad-0b4e8e2e7ce6.png)
   

The type() method returns the type of the resource returned by the query, expressed as a list of Covid type items. The resolve() method actually returns the list of covids by using the all() method of the Covid model.

In the same way, create a second file in the ./app/GraphQL/Queries directory called CovidQuery.php (note that, this time, covid is singular). In this file, add the following code:


![image](https://user-images.githubusercontent.com/33898897/125930215-25d96866-a58b-42cf-8eeb-1bff4b8de694.png)


# Registering the Schema 

After creating these types and queries, you need to register these items as the GraphQL schema in your API. So, open the graphql.php file (you will find it inside the config directory) and replace the current definition of 'schemas' with the following:


// ./config/graphql.php

![image](https://user-images.githubusercontent.com/33898897/125930807-8ed0eb5f-76cb-4727-aa28-925feac88023.png)


Here you are saying that the schema of your GraphQL API consists of two queries named covid and covids, mapped to CovidQuery and CovidsQuery classes respectively.

Then, in the same file, replace the current definition of 'types' with the following:


![image](https://user-images.githubusercontent.com/33898897/125930718-91fae17d-e2e1-48ba-b261-bf078fbbbd3e.png)


This definition maps the type GraphQL Covid to the CovidType class.

Now you are ready to use your GraphQL API. You could test the API by using curl, Postman, or any other HTTP client. 

GraphQL endpoint will be - http://BASE_URL/graphql


![image](https://user-images.githubusercontent.com/33898897/125932792-65271628-d3c8-474b-9fa4-86ece5c61c2e.png)

 - Response:

![image](https://user-images.githubusercontent.com/33898897/125932829-67c933dd-7e0a-4983-847c-fe4abd625357.png)


![image](https://user-images.githubusercontent.com/33898897/125930215-25d96866-a58b-42cf-8eeb-1bff4b8de694.png)

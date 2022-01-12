# step-5

#### ovreview

On this step we will look into the httpApi functionality 

### Step Instructions

Edit ``index.php`` to load the slim framework

````
<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, array $args) {
    $datetime = new DateTime();
    return $response->withJson(['datetime' => $datetime->format('c')]);
});

$app->run();
````

now run 
``serverless deploy function -f api``

since the api function was already deployed, and we didn't changed the cloudformation template we can use this form of 
deploy that is way faster.  

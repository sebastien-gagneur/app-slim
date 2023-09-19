<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write(json_encode(array("Hello" => "World")));
        return $response->withHeader('content-type', 'application/json');
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        //$group->get('/{id}', ViewUserAction::class);
    });

    $app->get('/user/{id}', function (Request $request, Response $response, array $args) {
        $id = $request->getAttribute('id');
        //$id = $args["id"]; same as teh previous instruction !
        $response->getBody()->write(json_encode(array("the user number is" => $id)));
        return $response ->withHeader('content-type', 'application/json');
    });

};



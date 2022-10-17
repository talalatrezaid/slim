<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

    // $app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
    //     $response->getBody()->write('Hello, World!');

    //     return $response;
    // });

 

return function (App $app) {
    $app->get('/', \App\Controllers\HomeController::class);
   
    $app->get('/get_orders', \App\Controllers\HomeController::class.":get_orders");
    
    $app->get('/insert_fake_customers', \App\Controllers\HomeController::class.":insert_fake_customers");
   
    $app->get('/insert_fake_orders', \App\Controllers\HomeController::class.":insert_fake_orders");

};
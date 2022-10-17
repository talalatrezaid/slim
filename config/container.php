<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Selective\Database\Connection;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },
 // Database connection
 "conn" => function (ContainerInterface $container) {
    return  new Connection($container->get(PDO::class));
    
},

PDO::class => function (ContainerInterface $container) {
    $settings = $container->get("settings")['db'];

    $driver = $settings['driver'];
    $host = $settings['host'];
    $dbname = $settings['database'];
    $username = $settings['username'];
    $password = $settings['password'];
    $charset = $settings['charset'];
   // $flags = $settings['flags'];
    $dsn = "$driver:host=$host;dbname=$dbname;charset=$charset";

    return new PDO($dsn, $username, $password,[]);
},
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },
];
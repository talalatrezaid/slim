<?php

use DI\ContainerBuilder;
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Add DI container definitions
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Create DI container instance
$container = $containerBuilder->build();
// Set view in Container
$container->set('view', function() {
    return Twig::create(__DIR__ . '/../src/templates',
        ['cache' => false]);
});


// Create Slim App instance
$app = $container->get(App::class);

// Add Twig-View Middleware
$app->add(TwigMiddleware::createFromContainer($app));

// Register routes
(require __DIR__ . '/routes.php')($app);

// Register middleware
(require __DIR__ . '/middleware.php')($app);

return $app;
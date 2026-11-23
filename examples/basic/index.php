<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Kern\Routing\Router;

$router = new Router();
$router->get('/', fn() => 'Welcome to kern!');
$router->post('/about', fn() => 'About kern');

echo $router->dispatch('GET', '/') . '<br>';
echo $router->dispatch('post', '/about') . '<br>';
echo $router->dispatch('GET', '/404') . '<br>';

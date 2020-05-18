<?php

use Router\Router;

require '../vendor/autoload.php';

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\ProfilController@index');
$router->get('/profil/:id', 'App\Controllers\ProfilController@show');

$router->run();
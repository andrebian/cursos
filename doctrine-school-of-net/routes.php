<?php

use Aura\Router\RouterContainer;
use Doctrine\ORM\EntityManager;
use Slim\Views\PhpRenderer;
use Zend\Diactoros\Request;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

/** @var EntityManager $entityManager */
$entityManager = require_once __DIR__ . '/config/doctrine.php';

$request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

$view = new PhpRenderer(__DIR__ . '/templates/');

$routerContainer = new RouterContainer();

$map = $routerContainer->getMap();
$generator = $routerContainer->getGenerator();

require_once __DIR__ . '/routes/categories.php';
require_once __DIR__ . '/routes/posts.php';

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

foreach ($route->attributes as $key => $value) {
    $request = $request->withAttribute($key, $value);
}

$callable = $route->handler;

/**
 * @var Response
 */
$response = $callable($request, new Response());

if ($response instanceof Response\RedirectResponse) {
    header('Location: ' . $response->getHeader('location')[0]);
} elseif ($response instanceof Response) {
    echo $response->getBody();
}

<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$paths = [
    dirname(__DIR__) . '/src/Entity'
];

$isDevMode = true;

$dbParams = [
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'root',
    'dbname' => 'doctrine_school_of_net'
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

return EntityManager::create($dbParams, $config);
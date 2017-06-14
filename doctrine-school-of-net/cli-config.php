<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with mechanism to retrieve EntityManager in your app
$entityManager = require_once __DIR__ . '/config/doctrine.php';

return ConsoleRunner::createHelperSet($entityManager);

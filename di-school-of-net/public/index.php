<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once 'config.php';
require_once 'services.php';

$cliente = $container['cliente'];

$listaClientes = $cliente->listar();

include_once './clients.list.php';
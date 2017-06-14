<?php

use SON\Conexao;
use SON\Cliente;
use Pimple\Container as Pimple;



$container['datahora'] = function(){
    return new \DateTime();
};

$container['conexao'] = function(Pimple $container){
    return new Conexao($container['host'], $container['db'], $container['user'], $container['password']);
};

$container['cliente'] = function(Pimple $container) {
    return new Cliente($container['conexao']);
};

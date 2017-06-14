<?php

class Container
{
    public static function getClient()
    {
        $cliente = new Cliente(self::getConexao());
        return $cliente;
    }
    
    public static function getConexao()
    {
        $conexao = new Conexao('localhost', 'di_school_of_net', 'root', 'root');
        return $conexao;
    }
}

<?php

namespace SON;

use SON\ConexaoInterface;

class Conexao implements ConexaoInterface
{

    private $host;
    private $db;
    private $user;
    private $password;
    
    
    public function __construct($host, $db, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->db = $db;
        $this->password = $password;      
    }
    
    public function connect()
    {
        return new \PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->password);
    }

}

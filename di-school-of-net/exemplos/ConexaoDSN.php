<?php
require_once 'ConexaoInterface.php';

class ConexaoDSN implements ConexaoInterface
{
    private $dsn;
    private $user;
    private $password;
    
    
    public function __construct($dsn, $user, $password)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
    }
    
    public function connect()
    {
        return new \PDO($this->dsn, $this->user, $this->password);
    }
}

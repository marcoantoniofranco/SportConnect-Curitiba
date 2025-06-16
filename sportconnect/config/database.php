<?php

class Database 
{
    private $host = "localhost";
    private $dbname = "sportconnect";
    private $usuario = "root";
    private $senha = "";

    private $pdo;
    public $msgErro = "";

    public function conectar()
    {
        try {
            $this->pdo = new PDO("mysql:dbname=" . $this->dbname . ";host=" . $this->host, $this->usuario, $this->senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $erro) {
            $this->msgErro = "Erro na conexão: " . $erro->getMessage();
            return false;
        }
    }

    public function getConexao()
    {
        if ($this->pdo == null) {
            $this->conectar();
        }
        return $this->pdo;
    }
}

?>
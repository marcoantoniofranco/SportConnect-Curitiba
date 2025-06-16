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
            error_log("Erro de conexão com o banco: " . $erro->getMessage());
            return false;
        }
    }

    public function getConexao()
    {
        if ($this->pdo == null) {
            $conexao = $this->conectar();
            if ($conexao === false) {
                error_log("Falha ao conectar ao banco de dados: " . $this->msgErro);
                throw new Exception("Falha ao conectar ao banco de dados: " . $this->msgErro);
            }
        }
        return $this->pdo;
    }
}

?>
<?php

require_once '../config/database.php';

class Category
{
    private $db;
    private $id_categoria;
    private $nome;
    private $descricao;
    
    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function findAll()
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "SELECT * FROM categorias_esportivas ORDER BY nome ASC";
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function findById($id)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "SELECT * FROM categorias_esportivas WHERE id_categoria = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->id_categoria = $resultado['id_categoria'];
                $this->nome = $resultado['nome'];
                $this->descricao = $resultado['descricao'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function create($dados)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "INSERT INTO categorias_esportivas (nome, descricao) VALUES (:nome, :descricao)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':descricao', $dados['descricao']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function update($id, $dados)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "UPDATE categorias_esportivas SET nome = :nome, descricao = :descricao WHERE id_categoria = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':descricao', $dados['descricao']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function delete($id)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "DELETE FROM categorias_esportivas WHERE id_categoria = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function getId()
    {
        return $this->id_categoria;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function getDescricao()
    {
        return $this->descricao;
    }
}

?>
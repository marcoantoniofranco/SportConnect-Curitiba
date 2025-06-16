<?php

require_once __DIR__ . '/../config/database.php';

class Post
{
    private $db;
    private $id_publicacao;
    private $id_usuario;
    private $id_categoria;
    private $titulo;
    private $descricao;
    private $local;
    private $data_evento;
    private $vagas;
    
    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function create($dados)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "INSERT INTO publicacoes (id_usuario, id_categoria, titulo, descricao, local, data_evento, vagas) VALUES (:id_usuario, :id_categoria, :titulo, :descricao, :local, :data_evento, :vagas)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id_usuario', $dados['id_usuario']);
            $stmt->bindParam(':id_categoria', $dados['id_categoria']);
            $stmt->bindParam(':titulo', $dados['titulo']);
            $stmt->bindParam(':descricao', $dados['descricao']);
            $stmt->bindParam(':local', $dados['local']);
            $stmt->bindParam(':data_evento', $dados['data_evento']);
            $stmt->bindParam(':vagas', $dados['vagas']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function findById($id)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "SELECT * FROM publicacoes WHERE id_publicacao = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->id_publicacao = $resultado['id_publicacao'];
                $this->id_usuario = $resultado['id_usuario'];
                $this->id_categoria = $resultado['id_categoria'];
                $this->titulo = $resultado['titulo'];
                $this->descricao = $resultado['descricao'];
                $this->local = $resultado['local'];
                $this->data_evento = $resultado['data_evento'];
                $this->vagas = $resultado['vagas'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function findAll()
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "SELECT * FROM publicacoes ORDER BY data_evento ASC";
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function findByUserId($id_usuario)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "SELECT * FROM publicacoes WHERE id_usuario = :id_usuario ORDER BY data_evento ASC";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function update($id, $dados)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "UPDATE publicacoes SET id_categoria = :id_categoria, titulo = :titulo, descricao = :descricao, local = :local, data_evento = :data_evento, vagas = :vagas WHERE id_publicacao = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':id_categoria', $dados['id_categoria']);
            $stmt->bindParam(':titulo', $dados['titulo']);
            $stmt->bindParam(':descricao', $dados['descricao']);
            $stmt->bindParam(':local', $dados['local']);
            $stmt->bindParam(':data_evento', $dados['data_evento']);
            $stmt->bindParam(':vagas', $dados['vagas']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function delete($id)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "DELETE FROM publicacoes WHERE id_publicacao = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function getId()
    {
        return $this->id_publicacao;
    }
    
    public function getUserId()
    {
        return $this->id_usuario;
    }
    
    public function getCategoryId()
    {
        return $this->id_categoria;
    }
    
    public function getTitulo()
    {
        return $this->titulo;
    }
    
    public function getDescricao()
    {
        return $this->descricao;
    }
    
    public function getLocal()
    {
        return $this->local;
    }
    
    public function getDataEvento()
    {
        return $this->data_evento;
    }
    
    public function getVagas()
    {
        return $this->vagas;
    }
}

?>
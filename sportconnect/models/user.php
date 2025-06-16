<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    private $db;
    private $id_usuario;
    private $nome;
    private $email;
    private $telefone;
    private $cpf;
    private $data_nascimento;
    
    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function findByEmail($email)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function create($dados)
    {
        try {
            $conexao = $this->db->getConexao();
            
            $sql = "SELECT id_usuario FROM usuarios WHERE email = :email";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->execute();
            if ($stmt->rowCount() > 0) return false;
            
            $sql = "INSERT INTO usuarios (nome, email, telefone, cpf, data_nascimento, senha) VALUES (:nome, :email, :telefone, :cpf, :data_nascimento, :senha)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':telefone', $dados['telefone']);
            $stmt->bindParam(':cpf', $dados['cpf']);
            $stmt->bindParam(':data_nascimento', $dados['data_nascimento']);
            $stmt->bindParam(':senha', $dados['senha']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function findById($id)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "SELECT * FROM usuarios WHERE id_usuario = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->id_usuario = $resultado['id_usuario'];
                $this->nome = $resultado['nome'];
                $this->email = $resultado['email'];
                $this->telefone = $resultado['telefone'];
                $this->cpf = $resultado['cpf'];
                $this->data_nascimento = $resultado['data_nascimento'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function getId()
    {
        return $this->id_usuario;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getName()
    {
        return $this->nome;
    }
    
    public function getWhatsapp()
    {
        return $this->telefone;
    }
    
    public function getTelefone()
    {
        return $this->telefone;
    }
    
    public function getCpf()
    {
        return $this->cpf;
    }
    
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }
    
    public function findByCpfAndBirthdate($cpf, $data_nascimento)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "SELECT * FROM usuarios WHERE cpf = :cpf AND data_nascimento = :data_nascimento";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':data_nascimento', $data_nascimento);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function updatePassword($id, $senha)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "UPDATE usuarios SET senha = :senha WHERE id_usuario = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':senha', $senha);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function saveRememberToken($user_id, $token)
    {
        try {
            $conexao = $this->db->getConexao();
            $expires_at = date('Y-m-d H:i:s', time() + (86400 * 30)); // 30 dias
            
            $sql = "INSERT INTO remember_tokens (user_id, token, expires_at) VALUES (:user_id, :token, :expires_at)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':expires_at', $expires_at);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function findByRememberToken($token)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "SELECT u.* FROM usuarios u 
                    INNER JOIN remember_tokens rt ON u.id_usuario = rt.user_id 
                    WHERE rt.token = :token AND rt.expires_at > NOW()";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function removeRememberToken($token)
    {
        try {
            $conexao = $this->db->getConexao();
            $sql = "DELETE FROM remember_tokens WHERE token = :token";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':token', $token);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>
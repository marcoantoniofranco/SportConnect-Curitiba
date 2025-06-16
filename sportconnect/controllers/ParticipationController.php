<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Post.php';

class ParticipationController {
    private $db;
    private $user;

    public function __construct() {
        $this->db = new Database();
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth/loginForm');
            exit();
        }
        $this->user = new User();
        $this->user->findById($_SESSION['user_id']);
    }

    public function apply($post_id) {
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Erro de segurança: Token inválido';
            header('Location: index.php?url=post/view/' . $post_id);
            exit();
        }

        $post = new Post();
        if (!$post->findById($post_id)) {
            $_SESSION['error'] = 'Evento não encontrado';
            header('Location: index.php?url=post/list');
            exit();
        }

        if ($post->getUserId() === $_SESSION['user_id']) {
            $_SESSION['error'] = 'Você não pode se candidatar ao seu próprio evento';
            header('Location: index.php?url=post/view/' . $post_id);
            exit();
        }

        $conexao = $this->db->getConexao();
        $sql = "SELECT id FROM participacoes WHERE id_usuario = :user_id AND id_publicacao = :post_id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'Você já se candidatou a este evento';
            header('Location: index.php?url=post/view/' . $post_id);
            exit();
        }

        $sql = "INSERT INTO participacoes (id_publicacao, id_usuario) VALUES (:post_id, :user_id)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Candidatura enviada com sucesso!';
            regenerarTokenCSRF();
        } else {
            $_SESSION['error'] = 'Erro ao enviar candidatura';
        }
        
        header('Location: index.php?url=post/view/' . $post_id);
        exit();
    }

    public function respond($participation_id) {
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Erro de segurança: Token inválido';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php?url=post/list'));
            exit();
        }

        $action = $_POST['action'] ?? '';
        $post_id = $_POST['post_id'] ?? '';

        if (!in_array($action, ['aceitar', 'rejeitar'])) {
            $_SESSION['error'] = 'Ação inválida';
            header('Location: index.php?url=post/view/' . $post_id);
            exit();
        }

        $conexao = $this->db->getConexao();
        $sql = "SELECT p.*, pub.id_usuario as author_id FROM participacoes p 
                JOIN publicacoes pub ON p.id_publicacao = pub.id_publicacao 
                WHERE p.id = :participation_id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':participation_id', $participation_id);
        $stmt->execute();
        $participation = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$participation) {
            $_SESSION['error'] = 'Participação não encontrada';
            header('Location: index.php?url=post/list');
            exit();
        }

        $post = new Post();
        if (!$post->findById($participation['id_publicacao'])) {
            $_SESSION['error'] = 'Evento não encontrado';
            header('Location: index.php?url=post/list');
            exit();
        }

        if ($participation['author_id'] !== $_SESSION['user_id']) {
            $_SESSION['error'] = 'Você não tem permissão para responder a esta candidatura';
            header('Location: index.php?url=post/view/' . $participation['id_publicacao']);
            exit();
        }

        $novo_status = $action === 'aceitar' ? 'aceito' : 'rejeitado';
        $sql = "UPDATE participacoes SET status = :status WHERE id = :participation_id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':status', $novo_status);
        $stmt->bindParam(':participation_id', $participation_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = $action === 'aceitar' ? 'Candidatura aceita!' : 'Candidatura rejeitada!';
            regenerarTokenCSRF();
        } else {
            $_SESSION['error'] = 'Erro ao processar resposta';
        }

        header('Location: index.php?url=post/view/' . $participation['id_publicacao']);
        exit();
    }
} 
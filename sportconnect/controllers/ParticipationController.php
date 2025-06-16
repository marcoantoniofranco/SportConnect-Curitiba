<?php

require_once __DIR__ . '/../config/database.php';
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
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
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

        $sql = "INSERT INTO participacoes (id_publicacao, id_usuario, status) VALUES (:post_id, :user_id, 'pendente')";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Candidatura enviada com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao enviar candidatura';
        }

        header('Location: index.php?url=post/view/' . $post_id);
        exit();
    }

    public function respond($participation_id, $status) {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Erro de segurança: Token inválido';
            header('Location: index.php?url=post/list');
            exit();
        }

        if (!in_array($status, ['aceito', 'recusado'])) {
            $_SESSION['error'] = 'Status inválido';
            header('Location: index.php?url=post/list');
            exit();
        }

        $conexao = $this->db->getConexao();
        $sql = "SELECT * FROM participacoes WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $participation_id);
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

        if ($post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error'] = 'Não autorizado';
            header('Location: index.php?url=post/list');
            exit();
        }

        $sql = "UPDATE participacoes SET status = :status WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $participation_id);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Participação ' . $status . ' com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar participação';
        }

        header('Location: index.php?url=post/view/' . $post->getId());
        exit();
    }
} 
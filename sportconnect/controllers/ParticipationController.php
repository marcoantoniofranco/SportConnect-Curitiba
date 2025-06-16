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
            header('Location: /login');
            exit();
        }
        $this->user = new User();
        $this->user->findById($_SESSION['user_id']);
    }

    public function apply($post_id) {
        require_once __DIR__ . "/../includes/csrf.php";
        
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Erro de segurança: Token inválido';
            header('Location: /posts/view/' . $post_id);
            exit();
        }

        $post = new Post();
        if (!$post->findById($post_id)) {
            $_SESSION['error'] = 'Post not found';
            header('Location: /posts');
            exit();
        }

        if ($post->getUserId() === $_SESSION['user_id']) {
            $_SESSION['error'] = 'You cannot apply to your own post';
            header('Location: /posts/view/' . $post_id);
            exit();
        }

        $conexao = $this->db->getConexao();
        $sql = "SELECT id FROM participacoes WHERE id_usuario = :user_id AND id_publicacao = :post_id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'You have already applied to this post';
            header('Location: /posts/view/' . $post_id);
            exit();
        }

        $sql = "INSERT INTO participacoes (id_publicacao, id_usuario, status) VALUES (:post_id, :user_id, 'pendente')";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Application submitted successfully';
        } else {
            $_SESSION['error'] = 'Error submitting application';
        }

        header('Location: /posts/view/' . $post_id);
        exit();
    }

    public function respond($participation_id, $status) {
        require_once __DIR__ . "/../includes/csrf.php";
        
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Erro de segurança: Token inválido';
            header('Location: /posts');
            exit();
        }

        if (!in_array($status, ['aceito', 'recusado'])) {
            $_SESSION['error'] = 'Invalid status';
            header('Location: /posts');
            exit();
        }

        $conexao = $this->db->getConexao();
        $sql = "SELECT * FROM participacoes WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $participation_id);
        $stmt->execute();
        $participation = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$participation) {
            $_SESSION['error'] = 'Participation not found';
            header('Location: /posts');
            exit();
        }

        $post = new Post();
        if (!$post->findById($participation['id_publicacao'])) {
            $_SESSION['error'] = 'Post not found';
            header('Location: /posts');
            exit();
        }

        if ($post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error'] = 'Unauthorized';
            header('Location: /posts');
            exit();
        }

        $sql = "UPDATE participacoes SET status = :status WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $participation_id);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Participation ' . $status . ' successfully';
        } else {
            $_SESSION['error'] = 'Error updating participation';
        }

        header('Location: /posts/view/' . $post->getId());
        exit();
    }
} 
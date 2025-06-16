<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/Category.php';

class PostController {
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

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validateCSRFToken($_POST['csrf_token'])) {
                $_SESSION['error'] = 'Invalid form submission';
                header('Location: /posts/create');
                exit();
            }

            $required_fields = ['titulo', 'descricao', 'local', 'data_evento', 'vagas', 'id_categoria'];
            foreach ($required_fields as $field) {
                if (empty($_POST[$field])) {
                    $_SESSION['error'] = 'All fields are required';
                    header('Location: /posts/create');
                    exit();
                }
            }

            $dados = [
                'id_usuario' => $_SESSION['user_id'],
                'id_categoria' => $_POST['id_categoria'],
                'titulo' => $_POST['titulo'],
                'descricao' => $_POST['descricao'],
                'local' => $_POST['local'],
                'data_evento' => $_POST['data_evento'],
                'vagas' => $_POST['vagas']
            ];

            $post = new Post();
            if ($post->create($dados)) {
                $_SESSION['success'] = 'Post created successfully';
                header('Location: /posts');
                exit();
            } else {
                $_SESSION['error'] = 'Error creating post';
                header('Location: /posts/create');
                exit();
            }
        }

        $category = new Category();
        $categories = $category->findAll();
        
        require_once 'views/posts/create.php';
    }

    public function edit($id) {
        $post = new Post();
        if (!$post->findById($id)) {
            $_SESSION['error'] = 'Post not found';
            header('Location: /posts');
            exit();
        }

        if ($post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error'] = 'Post not found or unauthorized';
            header('Location: /posts');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validateCSRFToken($_POST['csrf_token'])) {
                $_SESSION['error'] = 'Invalid form submission';
                header('Location: /posts/edit/' . $id);
                exit();
            }

            $required_fields = ['titulo', 'descricao', 'local', 'data_evento', 'vagas', 'id_categoria'];
            foreach ($required_fields as $field) {
                if (empty($_POST[$field])) {
                    $_SESSION['error'] = 'All fields are required';
                    header('Location: /posts/edit/' . $id);
                    exit();
                }
            }

            $dados = [
                'id_categoria' => $_POST['id_categoria'],
                'titulo' => $_POST['titulo'],
                'descricao' => $_POST['descricao'],
                'local' => $_POST['local'],
                'data_evento' => $_POST['data_evento'],
                'vagas' => $_POST['vagas']
            ];

            if ($post->update($id, $dados)) {
                $_SESSION['success'] = 'Post updated successfully';
                header('Location: /posts');
                exit();
            } else {
                $_SESSION['error'] = 'Error updating post';
                header('Location: /posts/edit/' . $id);
                exit();
            }
        }

        $category = new Category();
        $categories = $category->findAll();
        
        require_once 'views/posts/edit.php';
    }

    public function delete($id) {
        $post = new Post();
        if (!$post->findById($id)) {
            $_SESSION['error'] = 'Post not found';
            header('Location: /posts');
            exit();
        }

        if ($post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error'] = 'Post not found or unauthorized';
            header('Location: /posts');
            exit();
        }

        if ($post->delete($id)) {
            $_SESSION['success'] = 'Post deleted successfully';
        } else {
            $_SESSION['error'] = 'Error deleting post';
        }

        header('Location: /posts');
        exit();
    }

    public function list() {
        $post = new Post();
        $posts = $post->findAll();
        require_once 'views/posts/list.php';
    }

    public function view($id) {
        $post = new Post();
        if (!$post->findById($id)) {
            $_SESSION['error'] = 'Post not found';
            header('Location: /posts');
            exit();
        }

        $author = new User();
        $author->findById($post->getUserId());

        $category = new Category();
        $category->findById($post->getCategoryId());

        $conexao = $this->db->getConexao();
        $sql = "SELECT p.*, u.nome FROM participacoes p JOIN usuarios u ON p.id_usuario = u.id_usuario WHERE p.id_publicacao = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $participations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'views/posts/view.php';
    }
} 
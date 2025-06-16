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
    }

    private function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth/loginForm');
            exit();
        }
        if (!$this->user) {
            $this->user = new User();
            $this->user->findById($_SESSION['user_id']);
        }
    }

    public function create() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required_fields = ['title', 'description', 'location', 'event_date', 'slots', 'category_id'];
            $hasError = false;
            
            foreach ($required_fields as $field) {
                if (empty($_POST[$field])) {
                    $_SESSION['error_message'] = 'Todos os campos são obrigatórios';
                    $hasError = true;
                    break;
                }
            }

            if (!$hasError) {
                $event_datetime = $_POST['event_date'] . ' ' . $_POST['event_time'];
                
                $dados = [
                    'id_usuario' => $_SESSION['user_id'],
                    'id_categoria' => $_POST['category_id'],
                    'titulo' => $_POST['title'],
                    'descricao' => $_POST['description'],
                    'local' => $_POST['location'],
                    'data_evento' => $event_datetime,
                    'vagas' => $_POST['slots']
                ];

                $post = new Post();
                if ($post->create($dados)) {
                    $_SESSION['success_message'] = 'Evento criado com sucesso!';
                    header('Location: index.php?url=post/list');
                    exit();
                } else {
                    $_SESSION['error_message'] = 'Erro ao criar evento';
                }
            }
        }

        $category = new Category();
        $categories = $category->findAll();
        
        require_once __DIR__ . '/../views/posts/create.php';
    }

    public function edit($id) {
        $this->checkAuth();
        
        $post = new Post();
        if (!$post->findById($id)) {
            $_SESSION['error_message'] = 'Evento não encontrado';
            header('Location: index.php?url=post/list');
            exit();
        }

        if ($post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error_message'] = 'Você não tem permissão para editar este evento';
            header('Location: index.php?url=post/list');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required_fields = ['titulo', 'descricao', 'local', 'data_evento', 'vagas', 'id_categoria'];
            $hasError = false;
            
            foreach ($required_fields as $field) {
                if (empty($_POST[$field])) {
                    $_SESSION['error_message'] = 'Todos os campos são obrigatórios';
                    $hasError = true;
                    break;
                }
            }

            if (!$hasError) {
                $dados = [
                    'id_categoria' => $_POST['id_categoria'],
                    'titulo' => $_POST['titulo'],
                    'descricao' => $_POST['descricao'],
                    'local' => $_POST['local'],
                    'data_evento' => $_POST['data_evento'],
                    'vagas' => $_POST['vagas']
                ];

                if ($post->update($id, $dados)) {
                    $_SESSION['success_message'] = 'Evento atualizado com sucesso!';
                    header('Location: index.php?url=post/list');
                    exit();
                } else {
                    $_SESSION['error_message'] = 'Erro ao atualizar evento';
                }
            }
        }

        $category = new Category();
        $categories = $category->findAll();
        
        require_once __DIR__ . '/../views/posts/edit.php';
    }

    public function delete($id) {
        $this->checkAuth();
        
        $post = new Post();
        if (!$post->findById($id)) {
            $_SESSION['error_message'] = 'Evento não encontrado';
            header('Location: index.php?url=post/list');
            exit();
        }

        if ($post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error_message'] = 'Você não tem permissão para excluir este evento';
            header('Location: index.php?url=post/list');
            exit();
        }

        if ($post->delete($id)) {
            $_SESSION['success_message'] = 'Evento excluído com sucesso!';
        } else {
            $_SESSION['error_message'] = 'Erro ao excluir evento';
        }

        header('Location: index.php?url=post/list');
        exit();
    }

    public function list() {
        $post = new Post();
        $posts = $post->findAll();
        require_once __DIR__ . '/../views/posts/list.php';
    }

    public function view($id) {
        $post = new Post();
        if (!$post->findById($id)) {
            $_SESSION['error_message'] = 'Evento não encontrado';
            header('Location: index.php?url=post/list');
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

        require_once __DIR__ . '/../views/posts/view.php';
    }
} 
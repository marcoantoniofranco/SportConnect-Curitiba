<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/csrf.php';
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
            header('Location: index.php?url=auth/login');
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
            if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
                $_SESSION['error'] = 'Erro de segurança: Token inválido';
                header('Location: index.php?url=post/create');
                exit();
            }

            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $location = trim($_POST['location'] ?? '');
            $event_date = $_POST['event_date'] ?? '';
            $event_time = $_POST['event_time'] ?? '';
            $slots = $_POST['slots'] ?? '';
            $category_id = $_POST['category_id'] ?? '';

            if (empty($title) || empty($description) || empty($location) || 
                empty($event_date) || empty($event_time) || empty($slots) || empty($category_id)) {
                $_SESSION['error'] = 'Todos os campos são obrigatórios';
                
                $_SESSION['form_data'] = [
                    'title' => $title,
                    'description' => $description,
                    'location' => $location,
                    'event_date' => $event_date,
                    'event_time' => $event_time,
                    'slots' => $slots,
                    'category_id' => $category_id
                ];
                
                header('Location: index.php?url=post/create');
                exit();
            }

            $data_evento = $event_date . ' ' . $event_time . ':00';

            if (strtotime($data_evento) < time()) {
                $_SESSION['error'] = 'A data do evento não pode ser no passado';
                $_SESSION['form_data'] = [
                    'title' => $title,
                    'description' => $description,
                    'location' => $location,
                    'event_date' => $event_date,
                    'event_time' => $event_time,
                    'slots' => $slots,
                    'category_id' => $category_id
                ];
                header('Location: index.php?url=post/create');
                exit();
            }

            if (!is_numeric($slots) || $slots < 1 || $slots > 50) {
                $_SESSION['error'] = 'Número de vagas deve ser entre 1 e 50';
                $_SESSION['form_data'] = [
                    'title' => $title,
                    'description' => $description,
                    'location' => $location,
                    'event_date' => $event_date,
                    'event_time' => $event_time,
                    'slots' => $slots,
                    'category_id' => $category_id
                ];
                header('Location: index.php?url=post/create');
                exit();
            }

            $dados = [
                'id_usuario' => $_SESSION['user_id'],
                'id_categoria' => $category_id,
                'titulo' => $title,
                'descricao' => $description,
                'local' => $location,
                'data_evento' => $data_evento,
                'vagas' => $slots
            ];

            $post = new Post();
            if ($post->create($dados)) {
                unset($_SESSION['form_data']);
                $_SESSION['success'] = 'Evento criado com sucesso!';
                regenerarTokenCSRF();
                header('Location: index.php?url=post/list');
                exit();
            } else {
                $_SESSION['error'] = 'Erro ao criar evento. Tente novamente.';
                header('Location: index.php?url=post/create');
                exit();
            }
        }

        $category = new Category();
        $categories = $category->findAll();
        
        gerarTokenCSRF();
        
        require_once __DIR__ . '/../views/posts/create.php';
    }

    public function edit($id) {
        $this->checkAuth();
        
        $post = new Post();
        if (!$post->findById($id)) {
            $_SESSION['error'] = 'Evento não encontrado';
            header('Location: index.php?url=post/list');
            exit();
        }

        if ($post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error'] = 'Você não tem permissão para editar este evento';
            header('Location: index.php?url=post/list');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
                $_SESSION['error'] = 'Erro de segurança: Token inválido';
                header('Location: index.php?url=post/edit/' . $id);
                exit();
            }

            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $location = trim($_POST['location'] ?? '');
            $event_date = $_POST['event_date'] ?? '';
            $event_time = $_POST['event_time'] ?? '';
            $slots = $_POST['slots'] ?? '';
            $category_id = $_POST['category_id'] ?? '';

            if (empty($title) || empty($description) || empty($location) || 
                empty($event_date) || empty($event_time) || empty($slots) || empty($category_id)) {
                $_SESSION['error'] = 'Todos os campos são obrigatórios';
                header('Location: index.php?url=post/edit/' . $id);
                exit();
            }

            $data_evento = $event_date . ' ' . $event_time . ':00';

            $dados = [
                'id_categoria' => $category_id,
                'titulo' => $title,
                'descricao' => $description,
                'local' => $location,
                'data_evento' => $data_evento,
                'vagas' => $slots
            ];

            if ($post->update($id, $dados)) {
                $_SESSION['success'] = 'Evento atualizado com sucesso!';
                regenerarTokenCSRF();
                header('Location: index.php?url=post/view/' . $id);
                exit();
            } else {
                $_SESSION['error'] = 'Erro ao atualizar evento';
                header('Location: index.php?url=post/edit/' . $id);
                exit();
            }
        }

        $category = new Category();
        $categories = $category->findAll();
        
        gerarTokenCSRF();
        
        require_once __DIR__ . '/../views/posts/edit.php';
    }

    public function delete($id) {
        $this->checkAuth();
        
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Erro de segurança: Token inválido';
            header('Location: index.php?url=post/list');
            exit();
        }

        $post = new Post();
        if (!$post->findById($id)) {
            $_SESSION['error'] = 'Evento não encontrado';
            header('Location: index.php?url=post/list');
            exit();
        }

        if ($post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error'] = 'Você não tem permissão para excluir este evento';
            header('Location: index.php?url=post/list');
            exit();
        }

        if ($post->delete($id)) {
            $_SESSION['success'] = 'Evento excluído com sucesso!';
            regenerarTokenCSRF();
        } else {
            $_SESSION['error'] = 'Erro ao excluir evento';
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
            $_SESSION['error'] = 'Evento não encontrado';
            header('Location: index.php?url=post/list');
            exit();
        }

        $author = new User();
        $author->findById($post->getUserId());

        $category = new Category();
        $category->findById($post->getCategoryId());

        $conexao = $this->db->getConexao();
        $sql = "SELECT p.*, u.nome, u.email, u.telefone FROM participacoes p JOIN usuarios u ON p.id_usuario = u.id_usuario WHERE p.id_publicacao = :id ORDER BY p.status ASC, u.nome ASC";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $participations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        gerarTokenCSRF();

        require_once __DIR__ . '/../views/posts/view.php';
    }
} 
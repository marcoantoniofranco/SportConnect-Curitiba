<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../models/Category.php';

class CategoryController {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    private function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth/loginForm');
            exit();
        }
    }

    public function index() {
        $this->checkAuth();
        $category = new Category();
        $categories = $category->findAll();
        require_once __DIR__ . '/../views/categories/index.php';
    }

    public function create() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
                $_SESSION['error'] = 'Erro de segurança: Token inválido';
                header('Location: index.php?url=category/create');
                exit();
            }

            $nome = trim($_POST['nome'] ?? '');
            $descricao = trim($_POST['descricao'] ?? '');

            if (empty($nome)) {
                $_SESSION['error'] = 'Nome da categoria é obrigatório';
                $_SESSION['form_data'] = [
                    'nome' => $nome,
                    'descricao' => $descricao
                ];
                header('Location: index.php?url=category/create');
                exit();
            }

            $dados = [
                'nome' => $nome,
                'descricao' => $descricao
            ];

            $category = new Category();
            if ($category->create($dados)) {
                unset($_SESSION['form_data']);
                $_SESSION['success'] = 'Categoria criada com sucesso!';
                regenerarTokenCSRF();
                header('Location: index.php?url=category/index');
                exit();
            } else {
                $_SESSION['error'] = 'Erro ao criar categoria. Tente novamente.';
                header('Location: index.php?url=category/create');
                exit();
            }
        }

        gerarTokenCSRF();
        require_once __DIR__ . '/../views/categories/create.php';
    }

    public function edit($id) {
        $this->checkAuth();
        
        $category = new Category();
        if (!$category->findById($id)) {
            $_SESSION['error'] = 'Categoria não encontrada';
            header('Location: index.php?url=category/index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
                $_SESSION['error'] = 'Erro de segurança: Token inválido';
                header('Location: index.php?url=category/edit/' . $id);
                exit();
            }

            $nome = trim($_POST['nome'] ?? '');
            $descricao = trim($_POST['descricao'] ?? '');

            if (empty($nome)) {
                $_SESSION['error'] = 'Nome da categoria é obrigatório';
                header('Location: index.php?url=category/edit/' . $id);
                exit();
            }

            $dados = [
                'nome' => $nome,
                'descricao' => $descricao
            ];

            if ($category->update($id, $dados)) {
                $_SESSION['success'] = 'Categoria atualizada com sucesso!';
                regenerarTokenCSRF();
                header('Location: index.php?url=category/index');
                exit();
            } else {
                $_SESSION['error'] = 'Erro ao atualizar categoria';
                header('Location: index.php?url=category/edit/' . $id);
                exit();
            }
        }

        gerarTokenCSRF();
        require_once __DIR__ . '/../views/categories/edit.php';
    }

    public function delete($id) {
        $this->checkAuth();
        
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Erro de segurança: Token inválido';
            header('Location: index.php?url=category/index');
            exit();
        }

        $category = new Category();
        if (!$category->findById($id)) {
            $_SESSION['error'] = 'Categoria não encontrada';
            header('Location: index.php?url=category/index');
            exit();
        }

        $conexao = $this->db->getConexao();
        $sql = "SELECT COUNT(*) as total FROM publicacoes WHERE id_categoria = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['total'] > 0) {
            $_SESSION['error'] = 'Não é possível excluir esta categoria pois existem eventos vinculados a ela';
            header('Location: index.php?url=category/index');
            exit();
        }

        if ($category->delete($id)) {
            $_SESSION['success'] = 'Categoria excluída com sucesso!';
            regenerarTokenCSRF();
        } else {
            $_SESSION['error'] = 'Erro ao excluir categoria';
        }

        header('Location: index.php?url=category/index');
        exit();
    }

    public function view($id) {
        $this->checkAuth();
        
        $category = new Category();
        if (!$category->findById($id)) {
            $_SESSION['error'] = 'Categoria não encontrada';
            header('Location: index.php?url=category/index');
            exit();
        }

        $conexao = $this->db->getConexao();
        $sql = "SELECT p.*, u.nome as autor FROM publicacoes p 
                JOIN usuarios u ON p.id_usuario = u.id_usuario 
                WHERE p.id_categoria = :id 
                ORDER BY p.data_evento ASC";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        gerarTokenCSRF();
        require_once __DIR__ . '/../views/categories/view.php';
    }
} 
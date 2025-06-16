<?php

require_once __DIR__ . '/../models/User.php';

class ProfileController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth/login');
            exit;
        }

        $user = new User();
        if (!$user->findById($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Usuário não encontrado.';
            header('Location: index.php?url=auth/login');
            exit;
        }

        require_once __DIR__ . '/../views/profile/index.php';
    }

    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth/login');
            exit;
        }

        $user = new User();
        if (!$user->findById($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Usuário não encontrado.';
            header('Location: index.php?url=auth/login');
            exit;
        }

        require_once __DIR__ . '/../views/profile/edit.php';
    }

    public function update() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            if (!$user->findById($_SESSION['user_id'])) {
                $_SESSION['error'] = 'Usuário não encontrado.';
                header('Location: index.php?url=profile/edit');
                exit;
            }

            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telefone = trim($_POST['telefone'] ?? '');

            if (empty($nome) || empty($email)) {
                $_SESSION['error'] = 'Nome e email são obrigatórios.';
                header('Location: index.php?url=profile/edit');
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Email inválido.';
                header('Location: index.php?url=profile/edit');
                exit;
            }

            $_SESSION['success'] = 'Perfil atualizado com sucesso!';
        }

        header('Location: index.php?url=profile/index');
        exit;
    }
}
?>
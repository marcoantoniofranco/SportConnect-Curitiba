<?php

require_once __DIR__ . '/../models/User.php';

class ProfileController {
    public function index () {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth/loginForm');
            exit();
        }

        $user = new User();
        if ($user->findById($_SESSION['user_id'])) {
            $userData = new stdClass();
            $userData->nome = $user->getNome();
            $userData->email = $user->getEmail();
            $userData->telefone = $user->getTelefone();
            $userData->bio = ""; 
            $userData->profile_photo = null;
            $userData->esportes = "";
        } else {
            $_SESSION['error_message'] = 'Usuário não encontrado.';
            header('Location: index.php?url=auth/loginForm');
            exit();
        }
        
        $user = $userData;
        require __DIR__ . "/../views/profile/index.php";
    }

    public function edit(){
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth/loginForm');
            exit();
        }

        $userModel = new User();
        if ($userModel->findById($_SESSION['user_id'])) {
            $userData = new stdClass();
            $userData->nome = $userModel->getNome();
            $userData->email = $userModel->getEmail();
            $userData->telefone = $userModel->getTelefone();
            $userData->bio = ""; 
            $userData->profile_photo = null;
            $userData->esportes = "";
        } else {
            $_SESSION['error_message'] = 'Usuário não encontrado.';
            header('Location: index.php?url=auth/loginForm');
            exit();
        }
        
        $user = $userData;

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        require __DIR__ . "/../views/profile/edit.php";
    }

    public function update() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth/loginForm');
            exit();
        }

        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error_message'] = 'Erro de segurança. Tente novamente.';
            header('Location: index.php?url=profile/edit');
            exit();
        }

        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefone = $_POST['telefone'] ?? '';

        if(empty($nome) || empty($email)){
            $_SESSION['error_message'] = 'Nome e email são obrigatórios!';
            header('Location: index.php?url=profile/edit');
            exit();
        }

        $_SESSION['success_message'] = 'Perfil atualizado com sucesso!';
        header('Location: index.php?url=profile/index');
        exit();
    }
}
?>
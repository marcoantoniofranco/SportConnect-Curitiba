<?php
require_once __DIR__ . '/../includes/session.php';

class AuthController {
    public function loginForm() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function login() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error_message'] = 'Erro de segurança. Tente novamente.';
            header('Location: /login');
            exit();
        }
        unset($_SESSION['csrf_token']);

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error_message'] = 'Por favor, preencha todos os campos.';
            header('Location: /login');
            exit();
        }

        if ($email === 'teste@exemplo.com') {
            $hashed_password_for_test = password_hash('123456', PASSWORD_DEFAULT);
            
            if (password_verify($password, $hashed_password_for_test)) {
                setUserSession(1); 
                $_SESSION['user_name'] = 'Usuário Teste'; 
                
                header('Location: /dashboard'); 
                exit();
            }
        }
        $_SESSION['error_message'] = 'Email ou senha inválidos.';
        header('Location: /login');
        exit();
    }


    public function registerForm() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function register() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error_message'] = 'Erro de segurança. Tente novamente.';
            header('Location: /register');
            exit();
        }
        unset($_SESSION['csrf_token']);

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            $_SESSION['error_message'] = 'Todos os campos são obrigatórios.';
            header('Location: /register');
            exit();
        }

        if ($password !== $confirm_password) {
            $_SESSION['error_message'] = 'As senhas não coincidem.';
            header('Location: /register');
            exit();
        }
        $_SESSION['success_message'] = 'Cadastro realizado com sucesso! Faça o login.';
        header('Location: /login');
        exit();
    }

    public function recoverPasswordForm() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        require_once __DIR__ . '/../views/auth/recover.php';
    }

    public function recoverPassword() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error_message'] = 'Erro de segurança. Tente novamente.';
            header('Location: /recover-password');
            exit();
        }
        unset($_SESSION['csrf_token']);

        $_SESSION['success_message'] = 'Se os dados estiverem corretos, um email de recuperação será enviado.';
        header('Location: /recover-password');
        exit();
    }
    
    public function logout() {
        logout();
        header('Location: /login');
        exit();
    }
}
<?php

require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../models/User.php';

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
            header('Location: index.php?url=auth/loginForm');
            exit();
        }
        unset($_SESSION['csrf_token']);

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $remember_me = isset($_POST['remember_me']);

        if (empty($email) || empty($password)) {
            $_SESSION['error_message'] = 'Por favor, preencha todos os campos.';
            header('Location: index.php?url=auth/loginForm');
            exit();
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);
        if ($user && password_verify($password, $user['senha'])) {
            setUserSession($user['id_usuario']);
            $_SESSION['user_name'] = $user['nome'];

            if ($remember_me) {
                $token = bin2hex(random_bytes(32));
                setcookie('remember_token', $token, time() + (86400 * 30), '/', '', true, true); // 30 dias, seguro e httpOnly
                
                // Salvar o token no banco
                $userModel->saveRememberToken($user['id_usuario'], $token);
            }

            header('Location: index.php?url=home/index');
            exit();
        }

        $_SESSION['error_message'] = 'Email ou senha inválidos.';
        header('Location: index.php?url=auth/loginForm');
        exit();
    }

    public function checkRememberMe() {
        if (isset($_COOKIE['remember_token'])) {
            $token = $_COOKIE['remember_token'];
            $userModel = new User();
            $user = $userModel->findByRememberToken($token);
            
            if ($user) {
                setUserSession($user['id_usuario']);
                $_SESSION['user_name'] = $user['nome'];
                return true;
            }
            
            // Se o token for inválido, remove o cookie
            setcookie('remember_token', '', time() - 3600, '/');
        }
        return false;
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
            header('Location: index.php?url=auth/registerForm');
            exit();
        }
        unset($_SESSION['csrf_token']);

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            $_SESSION['error_message'] = 'Todos os campos são obrigatórios.';
            header('Location: index.php?url=auth/registerForm');
            exit();
        }

        if ($password !== $confirm_password) {
            $_SESSION['error_message'] = 'As senhas não coincidem.';
            header('Location: index.php?url=auth/registerForm');
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $dadosNovoUsuario = [
            'nome' => $name,
            'email' => $email,
            'senha' => $hashedPassword,
            'telefone' => $_POST['phone'] ?? '',
            'cpf' => $_POST['cpf'] ?? '',
            'data_nascimento' => $_POST['birth_date'] ?? ''
        ];
        $userModel = new User();
        if ($userModel->create($dadosNovoUsuario)) {
            $_SESSION['success_message'] = 'Cadastro realizado com sucesso! Faça o login.';
            header('Location: index.php?url=auth/loginForm');
            exit();
        } else {
            $_SESSION['error_message'] = 'Ocorreu um erro ao criar sua conta.';
            header('Location: index.php?url=auth/registerForm');
            exit();
        }
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
            header('Location: index.php?url=auth/recoverPasswordForm');
            exit();
        }
        unset($_SESSION['csrf_token']);

        $cpf = $_POST['cpf'] ?? '';
        $data_nascimento = $_POST['birth_date'] ?? '';
        $userModel = new User();
        $user = $userModel->findByCpfAndBirthdate($cpf, $data_nascimento);
        if ($user) {
            $_SESSION['success_message'] = 'Dados validados! Entre em contato com o suporte para redefinir sua senha.';
            header('Location: index.php?url=auth/loginForm');
            exit();
        } else {
            $_SESSION['error_message'] = 'CPF ou Data de Nascimento não encontrados.';
            header('Location: index.php?url=auth/recoverPasswordForm');
            exit();
        }
    }

    public function resetPasswordForm() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        require_once __DIR__ . '/../views/auth/Reset.php';
    }

    public function updatePassword() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error_message'] = 'Erro de segurança. Tente novamente.';
            header('Location: index.php?url=auth/resetPasswordForm');
            exit();
        }
        unset($_SESSION['csrf_token']);

        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($new_password) || empty($confirm_password)) {
            $_SESSION['error_message'] = 'Todos os campos são obrigatórios.';
            header('Location: index.php?url=auth/resetPasswordForm');
            exit();
        }

        if ($new_password !== $confirm_password) {
            $_SESSION['error_message'] = 'As senhas não coincidem.';
            header('Location: index.php?url=auth/resetPasswordForm');
            exit();
        }

        if (strlen($new_password) < 6) {
            $_SESSION['error_message'] = 'A senha deve ter pelo menos 6 caracteres.';
            header('Location: index.php?url=auth/resetPasswordForm');
            exit();
        }

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = 'Sessão expirada. Faça login novamente.';
            header('Location: index.php?url=auth/loginForm');
            exit();
        }

        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $userModel = new User();
        
        if ($userModel->updatePassword($_SESSION['user_id'], $hashedPassword)) {
            $_SESSION['success_message'] = 'Senha alterada com sucesso!';
            header('Location: index.php?url=profile/index');
            exit();
        } else {
            $_SESSION['error_message'] = 'Erro ao alterar a senha. Tente novamente.';
            header('Location: index.php?url=auth/resetPasswordForm');
            exit();
        }
    }

    public function logout() {
        if (isset($_COOKIE['remember_token'])) {
            $token = $_COOKIE['remember_token'];
            $userModel = new User();
            $userModel->removeRememberToken($token);
            setcookie('remember_token', '', time() - 3600, '/');
        }
        logout();
        header('Location: index.php?url=auth/loginForm');
        exit();
    }
}
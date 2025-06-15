<?php

require_once __DIR__ . '/../includes/session.php';
// require_once __DIR__ . '/../models/User.php';

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

        if (empty($email) || empty($password)) {
            $_SESSION['error_message'] = 'Por favor, preencha todos os campos.';
            header('Location: index.php?url=auth/loginForm');
            exit();
        }

        /* CÓDIGO FINAL
         $userModel = new User();
         $user = $userModel->findByEmail($email);
         if ($user && password_verify($password, $user->senha)) {
             setUserSession($user->id_usuario);
             $_SESSION['user_name'] = $user->nome;
             header('Location: index.php?url=home/index');
             exit();
         } FIM DO CÓDIGO FINAL */


        // CÓDIGO TESTE (apagar oque estiver dentro quando acabar as classes)
        if ($email === 'teste@exemplo.com') {
            $hashed_password_for_test = password_hash('123456', PASSWORD_DEFAULT);
            
            if (password_verify($password, $hashed_password_for_test)) {
                setUserSession(1);
                $_SESSION['user_name'] = 'Usuário Teste';
                
                header('Location: index.php?url=home/index');
                exit();
            }
        } //FIM DO CÓDIGO TESTE

        $_SESSION['error_message'] = 'Email ou senha inválidos.';
        header('Location: index.php?url=auth/loginForm');
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

        /* CÓDIGO FINAL (descomentar quando O marquinhus acabar as classes)
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
         } FIM DO CÓDIGO FINAL*/ 

        //CÓDIGO TESTE (apagar)
        $_SESSION['success_message'] = 'Cadastro realizado com sucesso! Faça o login.';
        header('Location: index.php?url=auth/loginForm');
        exit();
        // FIM DO CÓDIGO TESTE
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

        /* CÓDIGO FINAL (descomentar depois)
         $cpf = $_POST['cpf'] ?? '';
         $data_nascimento = $_POST['birth_date'] ?? '';
         $userModel = new User();
         $user = $userModel->findByCpfAndBirthdate($cpf, $data_nascimento);
         if ($user) {
              // Lógica de sucesso na recuperação
         } else {
              // Lógica de falha
         } FIM DO CÓDIGO FINAL */


        //CÓDIGO TESTE (apagar)
        $_SESSION['success_message'] = 'Se os dados estiverem corretos, um email de recuperação será enviado.';
        header('Location: index.php?url=auth/recoverPasswordForm');
        exit(); //FIM DO CÓDIGO TESTE
    }

    public function logout() {
        logout();
        header('Location: index.php?url=auth/loginForm');
        exit();
    }
}
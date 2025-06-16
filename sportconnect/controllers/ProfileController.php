<?php
class ProfileController {
    public function index () {
        session_start();
        
        // Verificar se usuário está logado
        

        // Buscar dados do usuário no banco, código comentado para teste!
        require_once __DIR__ . "/../models/User.php";
        $user_id = $_SESSION['user_id'];
        $user = User::buscarPorId($user_id);

        require __DIR__ . "/../views/profile/index.php";
    }


    public function edit(){
        session_start();
        

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            require_once "../includes/csrf.php";
            require_once "../models/User.php";

            if (!validarTokenCSRF($_POST['csrf_token'])){
                die("Erro: CSRF Token inválido!");
            }

            $userId = $_SESSION['user_id'];
            $nome = $_POST['nome'];
            $esporte = $_POST['esporte'];

            if(empty($nome) || empty($esporte)){
                die('Todos os campos são obrigatórios!');
            }

            User::atualizar($userId, $nome, $esporte);

            header('Location: /SportConnect-Curitiba/sportconnect/profile');
            exit();
        }
        require __DIR__ . "/../views/profile/edit.php";
    }
}
?>

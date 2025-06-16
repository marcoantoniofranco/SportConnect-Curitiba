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
            $userData->nivel = "";
            $userData->localizacao = "";
            $userData->disponibilidade = "";
            $userData->idade = "";
        } else {
            $userData = new stdClass();
            $userData->nome = "João Silva";
            $userData->email = "joao.silva@email.com";
            $userData->telefone = "(41) 99999-8888";
            $userData->bio = "Apaixonado por esportes desde criança. Pratico futebol há mais de 10 anos e sempre busco novos desafios. Gosto de participar de campeonatos amadores e fazer novas amizades através do esporte.";
            $userData->profile_photo = null;
            $userData->esportes = "Futebol,Vôlei,Corrida,Basquete";
            $userData->nivel = "Intermediário";
            $userData->localizacao = "Curitiba, PR";
            $userData->disponibilidade = "Noites e fins de semana";
            $userData->idade = "28";
        }
        
        $user = $userData;
        require __DIR__ . "/../views/profile/index.php";
    }

    public function edit(){
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth/loginForm');
            exit();
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            require_once "../includes/csrf.php";

            if (!validarTokenCSRF($_POST['csrf_token'])){
                die("Erro: CSRF Token inválido!");
            }

            $userId = $_SESSION['user_id'];
            $nome = $_POST['nome'];
            $esporte = $_POST['esporte'];

            if(empty($nome) || empty($esporte)){
                die('Todos os campos são obrigatórios!');
            }

            header('Location: /SportConnect-Curitiba/sportconnect/profile');
            exit();
        }
        require __DIR__ . "/../views/profile/edit.php";
    }
}
?>
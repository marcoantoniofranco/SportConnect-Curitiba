<?php
class ProfileController {
    public function index () {
        session_start();
        
        // Verificar se usuário está logado
        

        // Buscar dados do usuário no banco, código comentado para teste!
        // require_once __DIR__ . "/../models/User.php";
        // $user_id = $_SESSION['user_id'];
        // $user = User::buscarPorId($user_id);

       // USUÁRIO TESTE PARA VERIFICAR COMO A PAGINA ESTÁ
        $user = new stdClass();
        $user->nome = "João Silva";
        $user->apelido = "Joãozinho";
        $user->email = "joao.silva@email.com";
        $user->telefone = "(41) 99999-8888";
        $user->bio = "Apaixonado por esportes desde criança. Pratico futebol há mais de 10 anos e sempre busco novos desafios. Gosto de participar de campeonatos amadores e fazer novas amizades através do esporte.";
        $user->profile_photo = null; // Will use default avatar
        $user->esportes = "Futebol,Vôlei,Corrida,Basquete";
        $user->nivel = "Intermediário";
        $user->localizacao = "Curitiba, PR";
        $user->disponibilidade = "Noites e fins de semana";
        $user->idade = "28";
        // Carregar a view
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

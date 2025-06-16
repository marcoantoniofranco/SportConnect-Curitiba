<?php 
$pageTitle = 'Sobre - SportConnect Curitiba';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="text-center mb-5">
        <i class="bi bi-trophy-fill text-primary" style="font-size: 4rem;"></i>
        <h1 class="display-4 fw-bold mt-3">Sobre o SportConnect</h1>
        <p class="lead text-muted">Conectando atletas e promovendo o esporte em Curitiba</p>
      </div>

      <div class="card mb-4">
        <div class="card-body p-4">
          <h3 class="card-title text-primary">
            <i class="bi bi-bullseye me-2"></i>Nossa Missão
          </h3>
          <p class="card-text">
            O SportConnect Curitiba é uma plataforma web que conecta pessoas interessadas em praticar esportes
            na região metropolitana de Curitiba. Nosso objetivo é facilitar a formação de grupos esportivos,
            conectar pessoas com interesses similares e promover a prática de atividades físicas de forma
            prática e segura.
          </p>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-body p-4">
          <h3 class="card-title text-primary">
            <i class="bi bi-gear me-2"></i>Como Funciona
          </h3>
          <p class="card-text mb-3">
            O sistema funciona como uma rede social esportiva onde usuários podem criar publicações
            procurando parceiros para atividades físicas e se candidatar para participar de grupos já formados.
          </p>

          <div class="alert alert-info">
            <h5 class="alert-heading">
              <i class="bi bi-lightbulb me-2"></i>Exemplo Prático
            </h5>
            <p class="mb-0">
              Um usuário precisa de mais pessoas para completar seu time de vôlei. Ele cria uma publicação
              informando <strong>"Preciso de 1 levantador para jogo de vôlei às 19h na Arena da UFPR"</strong>.
              Outros usuários interessados visualizam essa publicação e podem se candidatar para participar.
              O criador da publicação recebe as candidaturas e pode aceitar ou recusar os interessados.
            </p>
          </div>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-body p-4">
          <h3 class="card-title text-primary">
            <i class="bi bi-list-check me-2"></i>Principais Funcionalidades
          </h3>
          <div class="row">
            <div class="col-md-6">
              <ul class="list-unstyled">
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Página inicial informativa
                </li>
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Sistema completo de cadastro e login
                </li>
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Recuperação de senha segura
                </li>
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Perfil personalizado
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list-unstyled">
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Criação de publicações esportivas
                </li>
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Sistema de candidaturas
                </li>
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Categorias esportivas variadas
                </li>
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Troca de contatos facilitada
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-body p-4">
          <h3 class="card-title text-primary">
            <i class="bi bi-trophy me-2"></i>Esportes Suportados
          </h3>
          <p class="card-text mb-3">
            Nossa plataforma suporta diversas modalidades esportivas populares em Curitiba:
          </p>
          <div class="row text-center">
            <div class="col-6 col-md-3 mb-3">
              <i class="bi bi-dribbble text-primary fs-2"></i>
              <p class="mt-2 mb-0">Futebol</p>
            </div>
            <div class="col-6 col-md-3 mb-3">
              <i class="bi bi-circle text-primary fs-2"></i>
              <p class="mt-2 mb-0">Basquete</p>
            </div>
            <div class="col-6 col-md-3 mb-3">
              <i class="bi bi-volleyball text-primary fs-2"></i>
              <p class="mt-2 mb-0">Vôlei</p>
            </div>
            <div class="col-6 col-md-3 mb-3">
              <i class="bi bi-person-walking text-primary fs-2"></i>
              <p class="mt-2 mb-0">Corrida</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-body p-4">
          <h3 class="card-title text-primary">
            <i class="bi bi-shield-check me-2"></i>Segurança e Privacidade
          </h3>
          <p class="card-text">
            Quando um participante é aceito em um grupo, ele tem acesso aos dados de contato
            (nome, telefone, WhatsApp, email) dos demais participantes, facilitando a organização
            do encontro esportivo. Todos os dados são protegidos e utilizados apenas para fins esportivos.
          </p>
        </div>
      </div>

      <div class="text-center">
        <?php if (!isset($_SESSION['user_id'])): ?>
        <h4 class="mb-3">Pronto para se conectar?</h4>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
          <a href="index.php?url=auth/registerForm" class="btn btn-primary btn-lg">
            <i class="bi bi-person-plus me-2"></i>Criar Conta Grátis
          </a>
          <a href="index.php?url=auth/loginForm" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-box-arrow-in-right me-2"></i>Fazer Login
          </a>
        </div>
        <?php else: ?>
        <h4 class="mb-3">Explore a plataforma!</h4>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
          <a href="index.php?url=post/list" class="btn btn-primary btn-lg">
            <i class="bi bi-calendar-event me-2"></i>Ver Eventos
          </a>
          <a href="index.php?url=post/create" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-plus-circle me-2"></i>Criar Evento
          </a>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
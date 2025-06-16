<?php 
$pageTitle = 'SportConnect Curitiba - Conectando Atletas';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1 class="hero-title">Encontre seu Time em Curitiba</h1>
        <p class="hero-subtitle">
          Conecte-se com atletas, organize jogos e participe de uma comunidade esportiva ativa.
          O SportConnect facilita a formação de grupos esportivos em toda região metropolitana.
        </p>
        <div class="d-flex gap-3 flex-wrap">
          <?php if (!isset($_SESSION['user_id'])): ?>
          <a href="index.php?url=auth/registerForm" class="btn btn-light btn-lg">
            <i class="bi bi-person-plus me-2"></i>Começar Agora
          </a>
          <a href="#como-funciona" class="btn btn-outline-light btn-lg">
            <i class="bi bi-info-circle me-2"></i>Saiba Mais
          </a>
          <?php else: ?>
          <a href="index.php?url=post/list" class="btn btn-light btn-lg">
            <i class="bi bi-calendar-event me-2"></i>Ver Eventos
          </a>
          <a href="index.php?url=post/create" class="btn btn-outline-light btn-lg">
            <i class="bi bi-plus-circle me-2"></i>Criar Evento
          </a>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-lg-6 text-center">
        <i class="bi bi-people-fill text-white" style="font-size: 15rem; opacity: 0.3;"></i>
      </div>
    </div>
  </div>
</div>

<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold">Esportes Populares</h2>
      <p class="lead text-muted">Encontre pessoas para praticar seu esporte favorito</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 text-center event-card">
          <div class="card-body p-4">
            <div class="mb-3">
              <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-dribbble text-primary" style="font-size: 2.5rem;"></i>
              </div>
            </div>
            <h5 class="card-title">Futebol</h5>
            <p class="card-text text-muted">Monte seu time ou encontre partidas para completar o grupo</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 text-center event-card">
          <div class="card-body p-4">
            <div class="mb-3">
              <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-trophy text-primary" style="font-size: 2.5rem;"></i>
              </div>
            </div>
            <h5 class="card-title">Basquete</h5>
            <p class="card-text text-muted">Encontre jogadores para seu time e organize campeonatos</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 text-center event-card">
          <div class="card-body p-4">
            <div class="mb-3">
              <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-record-circle text-primary" style="font-size: 2.5rem;"></i>
              </div>
            </div>
            <h5 class="card-title">Vôlei</h5>
            <p class="card-text text-muted">Organize jogos e encontre levantadores, atacantes e líberos</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 text-center event-card">
          <div class="card-body p-4">
            <div class="mb-3">
              <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-person-arms-up text-primary" style="font-size: 2.5rem;"></i>
              </div>
            </div>
            <h5 class="card-title">Corrida</h5>
            <p class="card-text text-muted">Encontre parceiros para treinar e participar de corridas</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="como-funciona" class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold">Como Funciona</h2>
      <p class="lead text-muted">É simples conectar-se com outros atletas</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="text-center">
          <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
            <span class="fs-3 fw-bold">1</span>
          </div>
          <h4>Crie seu Perfil</h4>
          <p class="text-muted">
            Cadastre-se gratuitamente e personalize seu perfil esportivo com suas modalidades favoritas
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="text-center">
          <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
            <span class="fs-3 fw-bold">2</span>
          </div>
          <h4>Publique ou Participe</h4>
          <p class="text-muted">
            Crie publicações procurando parceiros ou candidate-se para participar de grupos já formados
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="text-center">
          <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
            <span class="fs-3 fw-bold">3</span>
          </div>
          <h4>Conecte-se e Jogue</h4>
          <p class="text-muted">
            Quando aceito no grupo, tenha acesso aos contatos dos participantes e organize o encontro
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h3 class="display-6 fw-bold mb-4">Exemplo Prático</h3>
        <div class="card border-primary">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
              <i class="bi bi-volleyball me-2"></i>Publicação de Vôlei
            </h5>
          </div>
          <div class="card-body">
            <p class="card-text">
              <strong>"Preciso de 1 levantador para jogo de vôlei às 19h na Arena da UFPR"</strong>
            </p>
            <small class="text-muted">
              <i class="bi bi-geo-alt me-1"></i>Arena UFPR •
              <i class="bi bi-clock me-1"></i>19:00 •
              <i class="bi bi-people me-1"></i>1 vaga
            </small>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="ps-lg-4">
          <h4>Como funciona:</h4>
          <ul class="list-unstyled">
            <li class="mb-2">
              <i class="bi bi-check-circle text-success me-2"></i>
              Usuário cria publicação com detalhes do jogo
            </li>
            <li class="mb-2">
              <i class="bi bi-check-circle text-success me-2"></i>
              Interessados se candidatam para participar
            </li>
            <li class="mb-2">
              <i class="bi bi-check-circle text-success me-2"></i>
              Criador aceita ou recusa as candidaturas
            </li>
            <li class="mb-2">
              <i class="bi bi-check-circle text-success me-2"></i>
              Participantes aceitos recebem contatos do grupo
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if (!isset($_SESSION['user_id'])): ?>
<section class="py-5 bg-primary text-white">
  <div class="container text-center">
    <h3 class="display-6 fw-bold mb-3">Pronto para começar?</h3>
    <p class="lead mb-4">Junte-se à maior comunidade esportiva de Curitiba</p>
    <div class="d-flex gap-3 justify-content-center flex-wrap">
      <a href="index.php?url=auth/registerForm" class="btn btn-light btn-lg">
        <i class="bi bi-person-plus me-2"></i>Criar Conta Grátis
      </a>
      <a href="index.php?url=auth/loginForm" class="btn btn-outline-light btn-lg">
        <i class="bi bi-box-arrow-in-right me-2"></i>Já tenho conta
      </a>
    </div>
  </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/../partials/footer.php'; ?>
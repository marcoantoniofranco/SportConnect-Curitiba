<?php 
$pageTitle = 'Eventos Esportivos - SportConnect Curitiba';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container py-5">
  <div class="row mb-4">
    <div class="col-lg-8">
      <h1 class="display-5 fw-bold mb-2">Eventos Esportivos</h1>
      <p class="lead text-muted">Encontre eventos esportivos em Curitiba ou crie o seu próprio</p>
    </div>
    <div class="col-lg-4 text-lg-end">
      <a href="index.php?url=post/create" class="btn btn-primary btn-lg">
        <i class="bi bi-plus-circle me-2"></i>Criar Evento
      </a>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-3">
          <select class="form-select">
            <option value="">Todos os Esportes</option>
            <option value="futebol">Futebol</option>
            <option value="volei">Vôlei</option>
            <option value="basquete">Basquete</option>
            <option value="corrida">Corrida</option>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-select">
            <option value="">Todas as Regiões</option>
            <option value="centro">Centro</option>
            <option value="batel">Batel</option>
            <option value="agua-verde">Água Verde</option>
            <option value="ufpr">UFPR</option>
          </select>
        </div>
        <div class="col-md-3">
          <input type="date" class="form-control" placeholder="Data do evento">
        </div>
        <div class="col-md-3">
          <button class="btn btn-outline-primary w-100">
            <i class="bi bi-search me-2"></i>Filtrar
          </button>
        </div>
      </div>
    </div>
  </div>

  <?php if (empty($posts)): ?>
  <div class="text-center py-5">
    <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
    <h3 class="mt-3 text-muted">Nenhum evento encontrado</h3>
    <p class="text-muted mb-4">Seja o primeiro a criar um evento esportivo!</p>
    <a href="index.php?url=post/create" class="btn btn-primary btn-lg">
      <i class="bi bi-plus-circle me-2"></i>Criar Primeiro Evento
    </a>
  </div>
  <?php else: ?>
  <div class="row g-4">
    <?php foreach ($posts as $post): ?>
    <div class="col-lg-4 col-md-6">
      <div class="card event-card h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <span class="badge bg-primary fs-6 px-3 py-2">
              <i class="bi bi-trophy me-1"></i>
              Esporte
            </span>
            <small class="text-muted">
              Hoje
            </small>
          </div>

          <h5 class="card-title mb-3">Evento Esportivo</h5>

          <p class="card-text text-muted mb-3">
            Descrição do evento esportivo...
          </p>

          <div class="event-info mb-3">
            <div class="d-flex align-items-center mb-2">
              <i class="bi bi-geo-alt text-primary me-2"></i>
              <span class="text-muted">Local do evento</span>
            </div>
            <div class="d-flex align-items-center mb-2">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">Data e hora</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-people text-primary me-2"></i>
              <span class="text-muted">Vagas disponíveis</span>
            </div>
          </div>
        </div>

        <div class="card-footer bg-transparent border-0 pt-0">
          <div class="d-flex gap-2 flex-wrap">
            <a href="#" class="btn btn-primary flex-fill">
              <i class="bi bi-eye me-1"></i>Ver Detalhes
            </a>

            <a href="#" class="btn btn-outline-secondary">
              <i class="bi bi-pencil"></i>
            </a>
            <button type="button" class="btn btn-outline-danger">
              <i class="bi bi-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <nav aria-label="Navegação de eventos" class="mt-5">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">Anterior</a>
      </li>
      <li class="page-item active">
        <a class="page-link" href="#">1</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">2</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">3</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">Próximo</a>
      </li>
    </ul>
  </nav>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
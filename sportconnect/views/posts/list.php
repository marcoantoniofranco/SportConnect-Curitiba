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

  <?php if (empty($posts)): ?>
  <div class="text-center py-5">
    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 120px; height: 120px;">
      <i class="bi bi-calendar-plus text-primary" style="font-size: 3rem;"></i>
    </div>
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
            <div class="d-flex align-items-center">
              <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                <i class="bi bi-calendar-event text-primary" style="font-size: 0.9rem;"></i>
              </div>
              <span class="badge bg-primary px-2 py-1">Evento</span>
            </div>
            <small class="text-muted">
              <i class="bi bi-clock me-1"></i><?php echo date('d/m/Y', strtotime($post['data_evento'])); ?>
            </small>
          </div>

          <h5 class="card-title mb-3"><?php echo htmlspecialchars($post['titulo']); ?></h5>

          <p class="card-text text-muted mb-3">
            <?php echo htmlspecialchars(substr($post['descricao'], 0, 100)) . '...'; ?>
          </p>

          <div class="event-info mb-3">
            <div class="d-flex align-items-center mb-2">
              <i class="bi bi-geo-alt text-primary me-2"></i>
              <span class="text-muted"><?php echo htmlspecialchars($post['local']); ?></span>
            </div>
            <div class="d-flex align-items-center mb-2">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($post['data_evento'])); ?></span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-people text-primary me-2"></i>
              <span class="text-muted"><?php echo $post['vagas']; ?> vagas</span>
            </div>
          </div>
        </div>

        <div class="card-footer bg-transparent border-0 pt-0">
          <div class="d-flex gap-2">
            <a href="index.php?url=post/view/<?php echo $post['id_publicacao']; ?>" class="btn btn-primary flex-fill">
              <i class="bi bi-eye me-1"></i>Ver Detalhes
            </a>
            <?php if ($post['id_usuario'] === $_SESSION['user_id']): ?>
            <a href="index.php?url=post/edit/<?php echo $post['id_publicacao']; ?>" class="btn btn-outline-secondary">
              <i class="bi bi-pencil"></i>
            </a>
            <form action="index.php?url=post/delete/<?php echo $post['id_publicacao']; ?>" method="POST" class="d-inline">
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
              <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este evento?')">
                <i class="bi bi-trash"></i>
              </button>
            </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
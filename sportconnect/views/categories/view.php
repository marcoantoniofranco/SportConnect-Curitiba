<?php require_once __DIR__ . "/../partials/header.php"; ?>

<div class="container mt-4">
  <?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-2"></i><?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle me-2"></i><?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h2 class="card-title mb-1">
            <i class="bi bi-trophy me-2"></i><?php echo htmlspecialchars($category->getNome()); ?>
          </h2>
          <p class="text-muted mb-0">Categoria Esportiva</p>
        </div>
        <div class="btn-group">
          <a href="index.php?url=category/edit/<?php echo $category->getId(); ?>" class="btn btn-warning">
            <i class="bi bi-pencil me-2"></i>Editar
          </a>
          <form action="index.php?url=category/delete/<?php echo $category->getId(); ?>" method="POST" class="d-inline">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
              <i class="bi bi-trash me-2"></i>Excluir
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-8">
          <h5><i class="bi bi-card-text me-2"></i>Descrição</h5>
          <p class="lead">
            <?php echo htmlspecialchars($category->getDescricao() ?: 'Nenhuma descrição disponível'); ?>
          </p>
        </div>
        <div class="col-md-4">
          <div class="card bg-light">
            <div class="card-body text-center">
              <h6 class="card-title"><i class="bi bi-bar-chart me-2"></i>Estatísticas</h6>
              <p class="display-6 text-primary mb-1"><?php echo count($posts); ?></p>
              <small class="text-muted">Eventos nesta categoria</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4><i class="bi bi-calendar-event me-2"></i>Eventos desta Categoria</h4>
      <a href="index.php?url=category/index" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Voltar às Categorias
      </a>
    </div>

    <?php if (empty($posts)): ?>
    <div class="card">
      <div class="card-body text-center py-5">
        <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
        <h5 class="text-muted mt-3">Nenhum evento encontrado</h5>
        <p class="text-muted">Ainda não há eventos criados para esta categoria.</p>
      </div>
    </div>
    <?php else: ?>
    <div class="row">
      <?php foreach ($posts as $post): ?>
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($post['titulo']); ?></h5>
            <p class="card-text text-muted">
              <?php echo htmlspecialchars(substr($post['descricao'], 0, 100) . (strlen($post['descricao']) > 100 ? '...' : '')); ?>
            </p>
            <div class="small text-muted mb-2">
              <i class="bi bi-person me-1"></i>Por: <?php echo htmlspecialchars($post['autor']); ?>
            </div>
            <div class="small text-muted mb-2">
              <i class="bi bi-geo-alt me-1"></i><?php echo htmlspecialchars($post['local']); ?>
            </div>
            <div class="small text-muted mb-3">
              <i class="bi bi-calendar me-1"></i><?php echo date('d/m/Y H:i', strtotime($post['data_evento'])); ?>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-primary"><?php echo $post['vagas']; ?> vagas</span>
              <a href="index.php?url=post/view/<?php echo $post['id_publicacao']; ?>" class="btn btn-sm btn-outline-primary">
                Ver Detalhes
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
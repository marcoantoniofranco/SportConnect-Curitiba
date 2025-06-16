<?php require_once __DIR__ . "/../partials/header.php"; ?>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title mb-0">
            <i class="bi bi-pencil me-2"></i>Editar Categoria: <?php echo htmlspecialchars($category->getNome()); ?>
          </h3>
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle me-2"></i><?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
          </div>
          <?php endif; ?>

          <form action="index.php?url=category/edit/<?php echo $category->getId(); ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">

            <div class="mb-4">
              <label for="nome" class="form-label fw-semibold">
                <i class="bi bi-tag me-2"></i>Nome da Categoria *
              </label>
              <input type="text" class="form-control form-control-lg" id="nome" name="nome" value="<?php echo htmlspecialchars($category->getNome()); ?>" placeholder="Ex: Futebol, Basquete, Tênis..." required>
              <div class="form-text">Escolha um nome claro e específico para a categoria esportiva</div>
            </div>

            <div class="mb-4">
              <label for="descricao" class="form-label fw-semibold">
                <i class="bi bi-card-text me-2"></i>Descrição
              </label>
              <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Descreva os tipos de atividades e modalidades desta categoria..."><?php echo htmlspecialchars($category->getDescricao()); ?></textarea>
              <div class="form-text">Opcional: Adicione detalhes sobre a categoria para ajudar os usuários</div>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-success btn-lg">
                <i class="bi bi-check-circle me-2"></i>Atualizar Categoria
              </button>
              <a href="index.php?url=category/view/<?php echo $category->getId(); ?>" class="btn btn-outline-info btn-lg">
                <i class="bi bi-eye me-2"></i>Visualizar
              </a>
              <a href="index.php?url=category/index" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i>Voltar
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
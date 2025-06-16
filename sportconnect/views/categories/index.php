<?php require_once __DIR__ . "/../partials/header.php"; ?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-trophy me-2"></i>Gerenciar Categorias</h2>
    <a href="index.php?url=category/create" class="btn btn-primary">
      <i class="bi bi-plus-circle me-2"></i>Nova Categoria
    </a>
  </div>

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
    <div class="card-body">
      <?php if (empty($categories)): ?>
      <div class="text-center py-5">
        <i class="bi bi-trophy text-muted" style="font-size: 4rem;"></i>
        <h4 class="text-muted mt-3">Nenhuma categoria encontrada</h4>
        <p class="text-muted">Crie a primeira categoria esportiva para começar.</p>
        <a href="index.php?url=category/create" class="btn btn-primary">
          <i class="bi bi-plus-circle me-2"></i>Criar Primeira Categoria
        </a>
      </div>
      <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Descrição</th>
              <th class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
              <td><span class="badge bg-secondary"><?php echo $category['id_categoria']; ?></span></td>
              <td>
                <strong><?php echo htmlspecialchars($category['nome']); ?></strong>
              </td>
              <td>
                <span class="text-muted">
                  <?php echo htmlspecialchars($category['descricao'] ?: 'Sem descrição'); ?>
                </span>
              </td>
              <td class="text-center">
                <div class="btn-group" role="group">
                  <a href="index.php?url=category/view/<?php echo $category['id_categoria']; ?>" class="btn btn-sm btn-outline-info" title="Visualizar">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="index.php?url=category/edit/<?php echo $category['id_categoria']; ?>" class="btn btn-sm btn-outline-warning" title="Editar">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="index.php?url=category/delete/<?php echo $category['id_categoria']; ?>" method="POST" class="d-inline">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
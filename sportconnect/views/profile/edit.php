<?php
$pageTitle = 'Editar Perfil - SportConnect Curitiba';
require_once __DIR__ . '/../partials/header.php';
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="text-center mb-5">
        <i class="bi bi-person-gear text-primary" style="font-size: 4rem;"></i>
        <h2 class="mt-3">Editar Perfil</h2>
        <p class="text-muted">Atualize suas informações pessoais</p>
      </div>

      <div class="card">
        <div class="card-body p-4">
          <form action="index.php?url=profile/update" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">

            <div class="row mb-4">
              <div class="col-md-6">
                <label for="nome" class="form-label fw-semibold">
                  <i class="bi bi-person me-2"></i>Nome Completo
                </label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($user->getNome() ?? ''); ?>" required>
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label fw-semibold">
                  <i class="bi bi-envelope me-2"></i>E-mail
                </label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user->getEmail() ?? ''); ?>" required>
              </div>
            </div>

            <div class="mb-4">
              <label for="telefone" class="form-label fw-semibold">
                <i class="bi bi-whatsapp me-2"></i>Telefone/WhatsApp
              </label>
              <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($user->getTelefone() ?? ''); ?>" placeholder="(41) 99999-9999">
              <div class="form-text">Este número será usado para contato entre participantes</div>
            </div>

            <div class="d-flex gap-3 justify-content-end">
              <a href="index.php?url=profile/index" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i>Cancelar
              </a>
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-circle me-2"></i>Salvar Alterações
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body text-center">
              <i class="bi bi-key text-warning" style="font-size: 2rem;"></i>
              <h6 class="mt-2">Alterar Senha</h6>
              <p class="text-muted small">Mantenha sua conta segura</p>
              <a href="index.php?url=auth/resetPasswordForm" class="btn btn-outline-warning">
                Alterar Senha
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
<?php
$pageTitle = 'Redefinir Senha - SportConnect Curitiba';
require_once __DIR__ . '/../partials/header.php';
?>

<div class="auth-container">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="auth-card">
          <div class="auth-header">
            <h3 class="mb-0">
              <i class="bi bi-key me-2"></i>
              Redefinir Senha
            </h3>
            <p class="mb-0 mt-2 opacity-75">Crie sua nova senha</p>
          </div>

          <div class="auth-body">
            <form action="index.php?url=auth/updatePassword" method="POST">
              <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

              <div class="mb-3">
                <label for="new_password" class="form-label">
                  <i class="bi bi-lock me-1"></i>Nova Senha
                </label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Digite sua nova senha" required minlength="6">
                <div class="form-text">A senha deve ter pelo menos 6 caracteres</div>
              </div>

              <div class="mb-4">
                <label for="confirm_password" class="form-label">
                  <i class="bi bi-lock-fill me-1"></i>Confirmar Nova Senha
                </label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirme sua nova senha" required minlength="6">
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                  <i class="bi bi-check-circle me-2"></i>Salvar Nova Senha
                </button>
                <a href="index.php?url=profile/index" class="btn btn-outline-secondary">
                  <i class="bi bi-arrow-left me-2"></i>Voltar ao Perfil
                </a>
              </div>
            </form>
          </div>
        </div>

        <div class="card mt-4">
          <div class="card-body">
            <h6 class="card-title">
              <i class="bi bi-shield-check text-success me-2"></i>
              Dicas de Segurança
            </h6>
            <ul class="list-unstyled mb-0 small text-muted">
              <li class="mb-1">
                <i class="bi bi-check2 text-success me-2"></i>
                Use pelo menos 8 caracteres
              </li>
              <li class="mb-1">
                <i class="bi bi-check2 text-success me-2"></i>
                Combine letras maiúsculas e minúsculas
              </li>
              <li class="mb-1">
                <i class="bi bi-check2 text-success me-2"></i>
                Inclua números e símbolos
              </li>
              <li class="mb-0">
                <i class="bi bi-check2 text-success me-2"></i>
                Evite informações pessoais óbvias
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const newPassword = document.getElementById('new_password');
  const confirmPassword = document.getElementById('confirm_password');

  function validatePasswords() {
    if (confirmPassword.value && newPassword.value !== confirmPassword.value) {
      confirmPassword.setCustomValidity('As senhas não coincidem');
    } else {
      confirmPassword.setCustomValidity('');
    }
  }

  newPassword.addEventListener('input', validatePasswords);
  confirmPassword.addEventListener('input', validatePasswords);
});
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
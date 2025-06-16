<?php 
$pageTitle = 'Login - SportConnect Curitiba';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="auth-container">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="auth-card">
          <div class="auth-header">
            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
              <i class="bi bi-person-check-fill text-primary" style="font-size: 2.5rem;"></i>
            </div>
            <h2 class="mt-3 mb-1">Bem-vindo de volta!</h2>
            <p class="text-muted">Entre na sua conta SportConnect</p>
          </div>

          <?php
          if (isset($_SESSION['error_message'])) {
              echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
              unset($_SESSION['error_message']);
          }
          if (isset($_SESSION['success_message'])) {
              echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
              unset($_SESSION['success_message']);
          }
          ?>

          <form method="POST" action="index.php?url=auth/login">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

            <div class="mb-3">
              <label for="email" class="form-label">
                <i class="bi bi-envelope me-1"></i>E-mail
              </label>
              <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="seu@email.com" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">
                <i class="bi bi-lock me-1"></i>Senha
              </label>
              <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Digite sua senha" required>
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember_me" value="1" id="remember_me">
                <label class="form-check-label" for="remember_me">
                  Lembrar-me
                </label>
              </div>
            </div>

            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
              </button>
            </div>

            <div class="text-center">
              <a href="index.php?url=auth/recoverPasswordForm" class="text-decoration-none">
                <i class="bi bi-question-circle me-1"></i>Esqueceu sua senha?
              </a>
            </div>
          </form>
        </div>

        <div class="text-center mt-4">
          <p class="text-muted">
            Ainda não tem uma conta?
            <a href="index.php?url=auth/registerForm" class="text-primary text-decoration-none fw-semibold">
              Cadastre-se aqui
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
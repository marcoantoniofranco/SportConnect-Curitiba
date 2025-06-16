<?php 
$pageTitle = 'Login - SportConnect Curitiba';
include __DIR__ . '/../partials/header.php'; 
?>

<<<<<<< Updated upstream
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-4">
    <div class="card shadow-lg border-0">
      <div class="card-body p-5">
        <div class="text-center mb-4">
          <i class="bi bi-trophy-fill text-primary" style="font-size: 3rem;"></i>
          <h2 class="mt-3 mb-1">Bem-vindo de volta!</h2>
          <p class="text-muted">Entre na sua conta SportConnect</p>
=======
        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<p>' . htmlspecialchars($_SESSION['error_message']) . '</p>';
            unset($_SESSION['error_message']);
        }
        if (isset($_SESSION['success_message'])) {
            echo '<p>' . htmlspecialchars($_SESSION['success_message']) . '</p>';
            unset($_SESSION['success_message']);
        }
        ?>

        <form action="index.php?url=auth/login" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="remember_me" value="1"> Lembrar-me
                </label>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

            <button type="submit" class="btn-primary">Entrar</button>
        </form>

        <div class="links">
            <a href="index.php?url=auth/registerForm">Cadastrar-se</a>
            <a href="index.php?url=auth/recoverPasswordForm">Esqueci minha senha</a><br>
            <a href="/SportConnect-Curitiba/sportconnect/home/index">Voltar ao início</a>
>>>>>>> Stashed changes
        </div>

        <form method="POST" action="index.php?url=auth/login">
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

          <div class="mb-3">
            <label for="email" class="form-label">
              <i class="bi bi-envelope me-1"></i>E-mail
            </label>
            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="seu@email.com" required>
          </div>

          <div class="mb-4">
            <label for="password" class="form-label">
              <i class="bi bi-lock me-1"></i>Senha
            </label>
            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Digite sua senha" required>
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

<?php include __DIR__ . '/../partials/footer.php'; ?>
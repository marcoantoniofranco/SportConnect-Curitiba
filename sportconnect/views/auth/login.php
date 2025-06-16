<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SportConnect Curitiba</title>
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>

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
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

      <button type="submit" class="btn-primary">Entrar</button>
    </form>

    <div class="links">
      <a href="index.php?url=auth/registerForm">Cadastrar-se</a>
      <a href="index.php?url=auth/recoverPasswordForm">Esqueci minha senha</a><br>
      <a href="/SportConnect-Curitiba/sportconnect/home/index">Voltar ao início</a>
    </div>
  </div>

</body>

</html>
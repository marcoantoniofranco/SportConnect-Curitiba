<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Redefinir Senha</title>
</head>

<body>
  <h2>Crie sua Nova Senha</h2>

  <?php if (isset($_SESSION['error_message'])): ?>
  <p style="color: red;"><?php echo htmlspecialchars($_SESSION['error_message']); ?></p>
  <?php unset($_SESSION['error_message']); ?>
  <?php endif; ?>

  <form action="index.php?url=auth/updatePassword" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

    <div>
      <label for="new_password">Nova Senha:</label>
      <input type="password" id="new_password" name="new_password" required>
    </div>
    <div>
      <label for="confirm_password">Confirmar Nova Senha:</label>
      <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <button type="submit">Salvar Nova Senha</button>
  </form>
</body>

</html>
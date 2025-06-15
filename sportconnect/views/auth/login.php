<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SportConnect Curitiba</title>
</head>
<body>
    <?php include_once __DIR__ . "/../partials/header.php"; ?>
    <div class="login-container">
        <h2>Login</h2>

        <?php
         if (isset($_SESSION['error_message'])) {
            echo '<p>' . htmlspecialchars($_SESSION['error_message']) . '</p>';
            unset($_SESSION['error_message']); // Limpa a mensagem após exibir
        }
        if (isset($_SESSION['success_message'])) {
            echo '<p>' . htmlspecialchars($_SESSION['success_message']) . '</p>';
            unset($_SESSION['success_message']); // Limpa a mensagem após exibir
        }
        ?>

        <form action="/SportConnect-Curitiba/sportconnect/auth/login" method="POST"> <div class="form-group">
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
            <a href=/SportConnect-Curitiba/sportconnect/auth/register">Cadastrar-se</a> |
            <a href="/SportConnect-Curitiba/sportconnect/auth/recover">Esqueci minha senha</a>
        </div>
    </div>
    <?php include_once __DIR__ . "/../partials/footer.php"; ?>
</body>
</html>
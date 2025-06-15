<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - SportConnect Curitiba</title>
</head>
<body>
    <?php include_once __DIR__ . "/../partials/header.php"; ?>
    <div>
        <h2>Recuperar Senha</h2>

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

        <form action="/SportConnect-Curitiba/sportconnect/auth/recover" method="POST">
            <p>Informe seu CPF e Data de Nascimento para recuperar sua senha.</p>
            <div>
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required placeholder="XXX.XXX.XXX-XX">
            </div>
            <div>
                <label for="birth_date">Data de Nascimento:</label>
                <input type="date" id="birth_date" name="birth_date" required>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

            <button type="submit">Recuperar Senha</button>
        </form>

        <div>
            <a href="/login">Voltar para o Login</a>
        </div>
    </div>
    <?php include_once __DIR__ . "/../partials/footer.php"; ?>
</body>
</html>
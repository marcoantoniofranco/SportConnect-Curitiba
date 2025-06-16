<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - SportConnect Curitiba</title>
</head>
<body>
    <?php include_once __DIR__ . "/../partials/header.php"; ?>
    <div>
        <h2>Cadastro</h2>

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

        <form action="index.php?url=auth/register" method="POST">
            <div>
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="phone">Telefone:</label>
                <input type="tel" id="phone" name="phone" placeholder="(XX) XXXX-XXXX">
            </div>
            <div>
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required placeholder="XXX.XXX.XXX-XX">
            </div>
            <div>
                <label for="birth_date">Data de Nascimento:</label>
                <input type="date" id="birth_date" name="birth_date" required>
            </div>
            <div>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="confirm_password">Confirmar Senha:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

            <button type="submit">Cadastrar</button>
        </form>

        <div>
            <a href="index.php?url=auth/loginForm">Já tenho uma conta</a><br>
            <a href="/SportConnect-Curitiba/sportconnect/home/index">Voltar ao início</a>
        </div>
    </div>
    <?php include_once __DIR__ . "/../partials/footer.php"; ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/SportConnect-Curitiba/sportconnect/public/css/style.css">
    <title>Contato</title>
</head>
<body>
    <?php include_once __DIR__ . "/../partials/header.php"; ?>
    <main class="container">
        <section class="contact-section">
            <div class="contact-content">
                <h2>Fale Conosco</h2>
                <p>Tem alguma dúvida, sugestão ou precisa de ajuda? Entre em contato conosco!</p>

                <div class="contact-grid">
                    <div class="contact-card">
                        <h3>Atendimento</h3>
                        <p>Segunda a Sexta: 9h às 18h</p>
                        <p>Sábado: 9h às 12h</p>
                    </div>
                    <div class="contact-card">
                        <h3>Canais de Contato</h3>
                        <p>Email: contato@sportconnect.com.br</p>
                        <p>WhatsApp: (41) 99999-9999</p>
                    </div>
                    <div class="contact-card">
                        <h3>Redes Sociais</h3>
                        <p>Instagram: @sportconnect</p>
                        <p>Facebook: /sportconnect</p>
                    </div>
                </div>

                <div class="contact-form">
                    <h2>Formulário de Contato</h2>
                    <form action="/contato/enviar" method="POST">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="assunto">Assunto:</label>
                            <input type="text" id="assunto" name="assunto" required>
                        </div>
                        <div class="form-group">
                            <label for="mensagem">Mensagem:</label>
                            <textarea id="mensagem" name="mensagem" required></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Enviar Mensagem</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <?php include_once __DIR__ . "/../partials/footer.php"; ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/SportConnect-Curitiba/sportconnect/public/css/style.css">
    <title>SportConnect Curitiba - Conectando Atletas</title>
</head>
<body>
    <?php include_once __DIR__ . "/../partials/header.php"; ?>
    
    <main class="container">
        <section class="hero-section">
            <div class="hero-content">
                <h1>Encontre seu Time em Curitiba</h1>
                <p class="hero-text">Conecte-se com atletas, organize jogos e participe de uma comunidade esportiva ativa</p>
                <div class="hero-buttons">
                    <a href="/SportConnect-Curitiba/sportconnect/auth/register" class="btn-primary">Começar Agora</a>
                    <a href="/SportConnect-Curitiba/sportconnect/home/sobre" class="btn-secondary">Saiba Mais</a>
                </div>
            </div>
        </section>

        <section class="featured-sports">
            <h2>Esportes Populares</h2>
            <div class="sports-grid">
                <div class="sport-card">
                    <div class="sport-icon">⚽</div>
                    <h3>Futebol</h3>
                    <p>Monte seu time ou encontre partidas</p>
                </div>
                <div class="sport-card">
                    <div class="sport-icon">🏀</div>
                    <h3>Basquete</h3>
                    <p>Encontre jogadores para seu time</p>
                </div>
                <div class="sport-card">
                    <div class="sport-icon">🏐</div>
                    <h3>Vôlei</h3>
                    <p>Organize jogos e campeonatos</p>
                </div>
                <div class="sport-card">
                    <div class="sport-icon">🏃</div>
                    <h3>Corrida</h3>
                    <p>Encontre parceiros para treinar</p>
                </div>
            </div>
        </section>

        <section class="how-it-works">
            <h2>Como Funciona</h2>
            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3>Crie seu Perfil</h3>
                    <p>Cadastre-se gratuitamente e personalize seu perfil esportivo</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3>Encontre Pessoas</h3>
                    <p>Conecte-se com outros atletas da sua região</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3>Organize Jogos</h3>
                    <p>Crie eventos ou participe de atividades existentes</p>
                </div>
            </div>
        </section>
    </main>

    <?php include_once __DIR__ . "/../partials/footer.php"; ?>
</body>
</html>
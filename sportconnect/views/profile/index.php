<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/SportConnect-Curitiba/sportconnect/public/css/style.css">
    <title>Meu Perfil - SportConnect</title>
</head>
<body>
    <?php include_once __DIR__ . "/../partials/header.php"; ?>
    
    <main class="container">
        <section class="profile-section">
            <div class="profile-header">
                <div class="profile-image">
                    <?php
                    $profileImage = isset($user->profile_photo) ? 
                        "/SportConnect-Curitiba/sportconnect/public/uploads/" . $user->profile_photo : 
                        "/SportConnect-Curitiba/sportconnect/public/images/default-avatar.png";
                    ?>
                    <img src="<?php echo $profileImage; ?>" alt="Foto de Perfil">
                </div>
                <div class="profile-info">
                    <h1><?php echo htmlspecialchars($user->nome); ?></h1>
                    <?php if(isset($user->apelido)): ?>
                        <p class="nickname"><?php echo htmlspecialchars($user->apelido); ?></p>
                    <?php endif; ?>
                    <a href="/SportConnect-Curitiba/sportconnect/profile/edit" class="btn-edit">Editar Perfil</a>
                </div>
            </div>

            <div class="profile-content">
                <div class="info-section">
                    <h2>Informações Pessoais</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Email:</span>
                            <span class="value"><?php echo htmlspecialchars($user->email); ?></span>
                        </div>
                        <?php if(isset($user->telefone)): ?>
                        <div class="info-item">
                            <span class="label">Telefone:</span>
                            <span class="value"><?php echo htmlspecialchars($user->telefone); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if(isset($user->bio) && !empty($user->bio)): ?>
                <div class="bio-section">
                    <h2>Sobre mim</h2>
                    <p><?php echo nl2br(htmlspecialchars($user->bio)); ?></p>
                </div>
                <?php endif; ?>

                <?php if(isset($user->esportes)): ?>
                <div class="sports-section">
                    <h2>Esportes Favoritos</h2>
                    <div class="sports-grid">
                        <?php
                        $esportes = explode(',', $user->esportes);
                        foreach($esportes as $esporte): ?>
                            <div class="sport-tag"><?php echo htmlspecialchars($esporte); ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include_once __DIR__ . "/../partials/footer.php"; ?>
</body>
</html>
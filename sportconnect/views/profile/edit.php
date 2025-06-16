<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/SportConnect-Curitiba/sportconnect/public/css/style.css">
    <title>Editar Perfil - SportConnect</title>
</head>
<body>
    <?php include_once __DIR__ . "/../partials/header.php"; ?>
    
    <main class="container">
        <section class="profile-edit-section">
            <h1>Editar Perfil</h1>
            
            <div class="profile-edit-content">
                <form class="edit-form" action="/SportConnect-Curitiba/sportconnect/profile/edit" method="POST" enctype="multipart/form-data">
                    <?php
                    // Adicionar token CSRF que é verificado na função editarPerfil
                    require_once __DIR__ . "/../../includes/csrf.php";
                    $csrf_token = gerarTokenCSRF();
                    ?>
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                    <div class="profile-image-section">
                        <div class="profile-image-container">
                            <?php
                            $profileImage = isset($_FILES['profile_photo']) ? 
                                "/SportConnect-Curitiba/sportconnect/public/uploads/" . $_FILES['profile_photo']['name'] : 
                                "/SportConnect-Curitiba/sportconnect/public/images/default-avatar.png";
                            ?>
                            <img src="<?php echo $profileImage; ?>" alt="Foto de Perfil" id="profile-preview">
                            <div class="photo-upload-container">
                                <label for="profile-photo" class="change-photo-btn">Mudar Foto</label>
                                <input type="file" id="profile-photo" name="profile_photo" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nome">Nome Completo</label>
                            <input type="text" id="nome" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="apelido">Apelido (nome exibido)</label>
                            <input type="text" id="apelido" name="apelido">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="tel" id="telefone" name="telefone">
                        </div>

                        <div class="form-group full-width">
                            <label for="bio">Biografia</label>
                            <textarea id="bio" name="bio" rows="4"></textarea>
                        </div>

                        <div class="form-group full-width">
                            <label>Esportes Favoritos</label>
                            <div class="sports-selection">
                                <label class="sport-option">
                                    <input type="checkbox" name="sports[]" value="futebol">
                                    <span class="sport-label">⚽ Futebol</span>
                                </label>
                                <label class="sport-option">
                                    <input type="checkbox" name="sports[]" value="volei">
                                    <span class="sport-label">🏐 Vôlei</span>
                                </label>
                                <label class="sport-option">
                                    <input type="checkbox" name="sports[]" value="basquete">
                                    <span class="sport-label">🏀 Basquete</span>
                                </label>
                                <label class="sport-option">
                                    <input type="checkbox" name="sports[]" value="corrida">
                                    <span class="sport-label">🏃 Corrida</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Salvar Alterações</button>
                        <a href="/SportConnect-Curitiba/sportconnect/profile/verPerfil" class="btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <?php include_once __DIR__ . "/../partials/footer.php"; ?>
</body>
</html>
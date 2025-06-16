<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle ?? 'SportConnect Curitiba'; ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="index.php">
        <i class="bi bi-trophy-fill me-2"></i>
        SportConnect
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php?url=home/index">
              <i class="bi bi-house me-1"></i>Início
            </a>
          </li>
          <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?url=post/list">
              <i class="bi bi-calendar-event me-1"></i>Eventos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?url=post/create">
              <i class="bi bi-plus-circle me-1"></i>Criar Evento
            </a>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?url=home/about">
              <i class="bi bi-info-circle me-1"></i>Sobre
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?url=home/contact">
              <i class="bi bi-envelope me-1"></i>Contato
            </a>
          </li>
        </ul>

        <ul class="navbar-nav">
          <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true">
              <i class="bi bi-person-circle me-1"></i>
              <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuário'); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="index.php?url=profile/index">
                  <i class="bi bi-person me-2"></i>Meu Perfil
                </a></li>
              <li><a class="dropdown-item" href="index.php?url=profile/edit">
                  <i class="bi bi-pencil me-2"></i>Editar Perfil
                </a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="index.php?url=auth/logout">
                  <i class="bi bi-box-arrow-right me-2"></i>Sair
                </a></li>
            </ul>
          </li>
          <?php else: ?>
          <li class="nav-item me-2">
            <a class="btn btn-outline-primary" href="index.php?url=auth/loginForm">
              <i class="bi bi-box-arrow-in-right me-1"></i>Entrar
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary" href="index.php?url=auth/registerForm">
              <i class="bi bi-person-plus me-1"></i>Cadastrar
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    <?php if (isset($_SESSION['success_message'])): ?>
    <div class="container mt-3">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        <?php echo htmlspecialchars($_SESSION['success_message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    </div>
    <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
    <div class="container mt-3">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <?php echo htmlspecialchars($_SESSION['error_message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    </div>
    <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
  </main>
<?php 
$pageTitle = 'Meu Perfil - SportConnect Curitiba';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container py-5">
  <div class="row">
    <div class="col-lg-4 mb-4">
      <div class="card profile-card">
        <div class="card-body text-center p-4">
          <div class="mb-3">
            <div class="profile-avatar bg-primary d-flex align-items-center justify-content-center">
              <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
            </div>
          </div>

          <h3 class="mb-1"><?php echo htmlspecialchars($user->getNome()); ?></h3>
          <p class="text-muted mb-3">
            <i class="bi bi-geo-alt me-1"></i>Curitiba, PR
          </p>

          <div class="d-grid gap-2">
            <a href="index.php?url=profile/edit" class="btn btn-primary">
              <i class="bi bi-pencil me-2"></i>Editar Perfil
            </a>
            <a href="index.php?url=auth/resetPasswordForm" class="btn btn-outline-secondary">
              <i class="bi bi-key me-2"></i>Alterar Senha
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="bi bi-person me-2"></i>Informações Pessoais
          </h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Nome Completo</label>
              <p class="mb-0"><?php echo htmlspecialchars($user->getNome()); ?></p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">E-mail</label>
              <p class="mb-0"><?php echo htmlspecialchars($user->getEmail()); ?></p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Telefone/WhatsApp</label>
              <p class="mb-0">
                <i class="bi bi-whatsapp text-success me-1"></i>
                <?php echo htmlspecialchars($user->getTelefone()); ?>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body text-center py-5">
          <i class="bi bi-calendar-event text-primary" style="font-size: 3rem;"></i>
          <h5 class="mt-3">Explore Eventos Esportivos</h5>
          <p class="text-muted mb-4">Encontre eventos esportivos em Curitiba e conecte-se com outros atletas</p>
          <div class="d-flex gap-3 justify-content-center">
            <a href="index.php?url=post/list" class="btn btn-primary">
              <i class="bi bi-search me-2"></i>Ver Eventos
            </a>
            <a href="index.php?url=post/create" class="btn btn-outline-primary">
              <i class="bi bi-plus-circle me-2"></i>Criar Evento
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
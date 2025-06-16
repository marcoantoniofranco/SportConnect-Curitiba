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
            <?php if (isset($user->profile_photo) && !empty($user->profile_photo)): ?>
            <img src="uploads/<?php echo htmlspecialchars($user->profile_photo); ?>" alt="Foto de Perfil" class="profile-avatar">
            <?php else: ?>
            <div class="profile-avatar bg-primary d-flex align-items-center justify-content-center">
              <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
            </div>
            <?php endif; ?>
          </div>

          <h3 class="mb-1"><?php echo htmlspecialchars($user->nome); ?></h3>
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

      <div class="card mt-4">
        <div class="card-body">
          <h5 class="card-title mb-3">
            <i class="bi bi-graph-up me-2"></i>Estatísticas
          </h5>
          <div class="row text-center">
            <div class="col-6">
              <div class="stats-card">
                <div class="stats-number">12</div>
                <div class="stats-label">Eventos Criados</div>
              </div>
            </div>
            <div class="col-6">
              <div class="stats-card">
                <div class="stats-number">28</div>
                <div class="stats-label">Participações</div>
              </div>
            </div>
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
              <p class="mb-0"><?php echo htmlspecialchars($user->nome); ?></p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">E-mail</label>
              <p class="mb-0"><?php echo htmlspecialchars($user->email); ?></p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Telefone/WhatsApp</label>
              <p class="mb-0">
                <i class="bi bi-whatsapp text-success me-1"></i>
                <?php echo htmlspecialchars($user->telefone); ?>
              </p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Membro desde</label>
              <p class="mb-0">Janeiro 2024</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="bi bi-chat-quote me-2"></i>Sobre Mim
          </h5>
        </div>
        <div class="card-body">
          <?php if (isset($user->bio) && !empty($user->bio)): ?>
          <p class="mb-0"><?php echo nl2br(htmlspecialchars($user->bio)); ?></p>
          <?php else: ?>
          <p class="text-muted mb-0">
            <i class="bi bi-info-circle me-1"></i>
            Adicione uma descrição sobre você e seus interesses esportivos.
          </p>
          <a href="index.php?url=profile/edit" class="btn btn-sm btn-outline-primary mt-2">
            <i class="bi bi-plus me-1"></i>Adicionar Bio
          </a>
          <?php endif; ?>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="bi bi-trophy me-2"></i>Esportes Favoritos
          </h5>
        </div>
        <div class="card-body">
          <?php if (isset($user->esportes) && !empty($user->esportes)): ?>
          <div class="d-flex flex-wrap gap-2">
            <?php
                            $esportes = explode(',', $user->esportes);
                            foreach($esportes as $esporte): ?>
            <span class="badge bg-primary fs-6 px-3 py-2">
              <i class="bi bi-star me-1"></i><?php echo htmlspecialchars(trim($esporte)); ?>
            </span>
            <?php endforeach; ?>
          </div>
          <?php else: ?>
          <p class="text-muted mb-0">
            <i class="bi bi-info-circle me-1"></i>
            Adicione seus esportes favoritos para que outros atletas possam te encontrar.
          </p>
          <a href="index.php?url=profile/edit" class="btn btn-sm btn-outline-primary mt-2">
            <i class="bi bi-plus me-1"></i>Adicionar Esportes
          </a>
          <?php endif; ?>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="bi bi-clock-history me-2"></i>Atividade Recente
          </h5>
        </div>
        <div class="card-body">
          <div class="list-group list-group-flush">
            <div class="list-group-item d-flex align-items-center px-0">
              <div class="me-3">
                <i class="bi bi-plus-circle text-success fs-5"></i>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1">Criou evento "Futebol no Parque Barigui"</h6>
                <small class="text-muted">2 dias atrás</small>
              </div>
            </div>

            <div class="list-group-item d-flex align-items-center px-0">
              <div class="me-3">
                <i class="bi bi-person-check text-primary fs-5"></i>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1">Participou do evento "Vôlei na Arena UFPR"</h6>
                <small class="text-muted">1 semana atrás</small>
              </div>
            </div>

            <div class="list-group-item d-flex align-items-center px-0">
              <div class="me-3">
                <i class="bi bi-heart text-danger fs-5"></i>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1">Se juntou ao SportConnect</h6>
                <small class="text-muted">1 mês atrás</small>
              </div>
            </div>
          </div>

          <div class="text-center mt-3">
            <a href="index.php?url=post/list" class="btn btn-outline-primary">
              <i class="bi bi-calendar-event me-2"></i>Ver Todos os Eventos
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
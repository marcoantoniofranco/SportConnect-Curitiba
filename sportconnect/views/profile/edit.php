<?php 
$pageTitle = 'Editar Perfil - SportConnect Curitiba';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="text-center mb-5">
        <i class="bi bi-person-gear text-primary" style="font-size: 4rem;"></i>
        <h1 class="display-5 fw-bold mt-3">Editar Perfil</h1>
        <p class="lead text-muted">Mantenha suas informações atualizadas para melhor conexão com outros atletas</p>
      </div>

      <div class="card">
        <div class="card-body p-4">
          <form action="index.php?url=profile/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">

            <div class="text-center mb-5">
              <div class="position-relative d-inline-block">
                <?php if (isset($user->profile_photo) && !empty($user->profile_photo)): ?>
                <img src="uploads/<?php echo htmlspecialchars($user->profile_photo); ?>" alt="Foto de Perfil" class="profile-avatar" id="profile-preview">
                <?php else: ?>
                <div class="profile-avatar bg-primary d-flex align-items-center justify-content-center" id="profile-preview">
                  <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
                </div>
                <?php endif; ?>

                <label for="profile_photo" class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle" style="width: 40px; height: 40px;">
                  <i class="bi bi-camera"></i>
                </label>
                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="d-none">
              </div>
              <p class="text-muted mt-2 small">Clique no ícone da câmera para alterar sua foto</p>
            </div>

            <div class="row mb-4">
              <div class="col-md-6">
                <label for="nome" class="form-label fw-semibold">
                  <i class="bi bi-person me-2"></i>Nome Completo
                </label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($user->nome ?? ''); ?>" required>
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label fw-semibold">
                  <i class="bi bi-envelope me-2"></i>E-mail
                </label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user->email ?? ''); ?>" required>
              </div>
            </div>

            <div class="mb-4">
              <label for="telefone" class="form-label fw-semibold">
                <i class="bi bi-whatsapp me-2"></i>Telefone/WhatsApp
              </label>
              <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($user->telefone ?? ''); ?>" placeholder="(41) 99999-9999">
              <div class="form-text">Este número será usado para contato entre participantes</div>
            </div>

            <div class="mb-4">
              <label for="bio" class="form-label fw-semibold">
                <i class="bi bi-chat-quote me-2"></i>Sobre Mim
              </label>
              <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Conte um pouco sobre você, seus esportes favoritos, experiência..."><?php echo htmlspecialchars($user->bio ?? ''); ?></textarea>
              <div class="form-text">Ajude outros atletas a conhecer você melhor</div>
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">
                <i class="bi bi-trophy me-2"></i>Esportes Favoritos
              </label>
              <div class="row">
                <?php 
                                $userSports = isset($user->esportes) ? explode(',', $user->esportes) : [];
                                $sports = [
                                    'futebol' => '⚽ Futebol',
                                    'volei' => '🏐 Vôlei', 
                                    'basquete' => '🏀 Basquete',
                                    'corrida' => '🏃 Corrida',
                                    'tenis' => '🎾 Tênis',
                                    'natacao' => '🏊 Natação',
                                    'ciclismo' => '🚴 Ciclismo',
                                    'skate' => '🛹 Skate'
                                ];
                                
                                foreach ($sports as $value => $label): ?>
                <div class="col-md-6 col-lg-4 mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="esportes[]" value="<?php echo $value; ?>" id="sport_<?php echo $value; ?>" <?php echo in_array($value, $userSports) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="sport_<?php echo $value; ?>">
                      <?php echo $label; ?>
                    </label>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
              <div class="form-text">Selecione os esportes que você pratica ou tem interesse</div>
            </div>

            <div class="card bg-light mb-4">
              <div class="card-body">
                <h6 class="card-title">
                  <i class="bi bi-bell me-2"></i>Preferências de Notificação
                </h6>
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="notify_events" name="notify_events" checked>
                  <label class="form-check-label" for="notify_events">
                    Receber notificações sobre novos eventos
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="notify_applications" name="notify_applications" checked>
                  <label class="form-check-label" for="notify_applications">
                    Receber notificações sobre candidaturas nos meus eventos
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="notify_messages" name="notify_messages" checked>
                  <label class="form-check-label" for="notify_messages">
                    Receber notificações por e-mail
                  </label>
                </div>
              </div>
            </div>

            <div class="d-flex gap-3 justify-content-end">
              <a href="index.php?url=profile/index" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i>Cancelar
              </a>
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-circle me-2"></i>Salvar Alterações
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body text-center">
              <i class="bi bi-key text-warning" style="font-size: 2rem;"></i>
              <h6 class="mt-2">Alterar Senha</h6>
              <p class="text-muted small">Mantenha sua conta segura</p>
              <a href="index.php?url=auth/resetPasswordForm" class="btn btn-outline-warning btn-sm">
                Alterar Senha
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body text-center">
              <i class="bi bi-trash text-danger" style="font-size: 2rem;"></i>
              <h6 class="mt-2">Excluir Conta</h6>
              <p class="text-muted small">Ação irreversível</p>
              <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                Excluir Conta
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteAccountModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar Exclusão da Conta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
          <i class="bi bi-exclamation-triangle me-2"></i>
          <strong>Atenção!</strong> Esta ação não pode ser desfeita.
        </div>
        <p>Ao excluir sua conta, você perderá:</p>
        <ul>
          <li>Todos os seus eventos criados</li>
          <li>Histórico de participações</li>
          <li>Dados de perfil e configurações</li>
          <li>Conexões com outros atletas</li>
        </ul>
        <p>Digite <strong>EXCLUIR</strong> para confirmar:</p>
        <input type="text" class="form-control" id="confirmDelete" placeholder="Digite EXCLUIR">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn" disabled>Excluir Conta</button>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('profile_photo').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = document.getElementById('profile-preview');
      preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="profile-avatar">`;
    };
    reader.readAsDataURL(file);
  }
});

document.getElementById('confirmDelete').addEventListener('input', function(e) {
  const btn = document.getElementById('confirmDeleteBtn');
  btn.disabled = e.target.value !== 'EXCLUIR';
});

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
  alert('Funcionalidade de exclusão será implementada');
});
</script>

<?php include __DIR__ . '/../partials/footer.php'; ?>
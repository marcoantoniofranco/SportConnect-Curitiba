<?php 
require_once __DIR__ . "/../partials/header.php";
?>

<div class="container mt-4">
  <?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success">
    <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
  </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
  </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
          <h2 class="card-title"><?php echo htmlspecialchars($post->getTitulo()); ?></h2>
          <h6 class="card-subtitle mb-2 text-muted">
            <?php echo htmlspecialchars($category->getNome()); ?>
          </h6>
        </div>
        <?php if ($post->getUserId() === $_SESSION['user_id']): ?>
        <div>
          <a href="index.php?url=post/edit/<?php echo $post->getId(); ?>" class="btn btn-secondary">Editar</a>
          <form action="index.php?url=post/delete/<?php echo $post->getId(); ?>" method="POST" class="d-inline">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este evento?')">Excluir</button>
          </form>
        </div>
        <?php endif; ?>
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
          <h5>Detalhes do Evento</h5>
          <p>
            <i class="bi bi-geo-alt me-2"></i><strong>Local:</strong><br>
            <?php echo htmlspecialchars($post->getLocal()); ?>
          </p>
          <p>
            <i class="bi bi-calendar me-2"></i><strong>Data e Hora:</strong><br>
            <?php echo date('d/m/Y H:i', strtotime($post->getDataEvento())); ?>
          </p>
          <p>
            <i class="bi bi-people me-2"></i><strong>Vagas Disponíveis:</strong><br>
            <?php echo $post->getVagas(); ?> vagas
          </p>
        </div>
        <div class="col-md-6">
          <h5>Organizador</h5>
          <p>
            <i class="bi bi-person me-2"></i><strong>Nome:</strong><br>
            <?php echo htmlspecialchars($author->getNome()); ?>
          </p>
          <p>
            <i class="bi bi-envelope me-2"></i><strong>Email:</strong><br>
            <?php echo htmlspecialchars($author->getEmail()); ?>
          </p>
          <?php if ($author->getTelefone()): ?>
          <p>
            <i class="bi bi-whatsapp me-2"></i><strong>WhatsApp:</strong><br>
            <?php echo htmlspecialchars($author->getTelefone()); ?>
          </p>
          <?php endif; ?>
        </div>
      </div>

      <div class="mb-4">
        <h5>Descrição</h5>
        <p class="card-text"><?php echo nl2br(htmlspecialchars($post->getDescricao())); ?></p>
      </div>

      <?php if ($post->getUserId() !== $_SESSION['user_id']): ?>
      <div class="mb-4">
        <h5>Interessado em participar?</h5>
        <form action="index.php?url=participation/apply/<?php echo $post->getId(); ?>" method="POST">
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
          <button type="submit" class="btn btn-primary">Candidatar-se</button>
        </form>
      </div>
      <?php endif; ?>

      <?php if ($post->getUserId() === $_SESSION['user_id'] && !empty($participations)): ?>
      <div class="mt-4">
        <h5>Solicitações de Participação</h5>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($participations as $participation): ?>
              <tr>
                <td><?php echo htmlspecialchars($participation['nome']); ?></td>
                <td>
                  <span class="badge bg-<?php 
                                                echo $participation['status'] === 'pendente' ? 'warning' : 
                                                    ($participation['status'] === 'aceito' ? 'success' : 'danger'); 
                                            ?>">
                    <?php echo ucfirst($participation['status']); ?>
                  </span>
                </td>
                <td>
                  <?php if ($participation['status'] === 'pendente'): ?>
                  <form action="index.php?url=participation/respond/<?php echo $participation['id']; ?>/aceito" method="POST" class="d-inline">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
                    <button type="submit" class="btn btn-success btn-sm">Aceitar</button>
                  </form>
                  <form action="index.php?url=participation/respond/<?php echo $participation['id']; ?>/recusado" method="POST" class="d-inline">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Recusar</button>
                  </form>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="mt-4">
    <a href="index.php?url=post/list" class="btn btn-secondary">Voltar aos Eventos</a>
  </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
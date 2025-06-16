<?php 
require_once __DIR__ . "/../partials/header.php";
?>

<div class="container mt-4">
  <h2>Editar Evento</h2>

  <?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
  </div>
  <?php endif; ?>

  <form action="index.php?url=post/edit/<?php echo $post->getId(); ?>" method="POST" class="mt-4">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">

    <div class="mb-3">
      <label for="title" class="form-label">Título do Evento</label>
      <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post->getTitulo()); ?>" required>
    </div>

    <div class="mb-3">
      <label for="category_id" class="form-label">Categoria Esportiva</label>
      <select class="form-select" id="category_id" name="category_id" required>
        <option value="">Selecione uma categoria</option>
        <?php foreach ($categories as $category): ?>
        <option value="<?php echo $category['id_categoria']; ?>" <?php echo $category['id_categoria'] == $post->getCategoryId() ? 'selected' : ''; ?>>
          <?php echo htmlspecialchars($category['nome']); ?>
        </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Descrição</label>
      <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($post->getDescricao()); ?></textarea>
    </div>

    <div class="mb-3">
      <label for="location" class="form-label">Local</label>
      <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($post->getLocal()); ?>" required>
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <label for="event_date" class="form-label">Data do Evento</label>
        <input type="date" class="form-control" id="event_date" name="event_date" value="<?php echo date('Y-m-d', strtotime($post->getDataEvento())); ?>" required>
      </div>
      <div class="col-md-6">
        <label for="event_time" class="form-label">Horário</label>
        <input type="time" class="form-control" id="event_time" name="event_time" value="<?php echo date('H:i', strtotime($post->getDataEvento())); ?>" required>
      </div>
    </div>

    <div class="mb-3">
      <label for="slots" class="form-label">Número de Vagas</label>
      <input type="number" class="form-control" id="slots" name="slots" min="1" max="50" value="<?php echo $post->getVagas(); ?>" required>
    </div>

    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary">Atualizar Evento</button>
      <a href="index.php?url=post/view/<?php echo $post->getId(); ?>" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
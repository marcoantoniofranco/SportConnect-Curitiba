<?php 
$pageTitle = 'Criar Evento - SportConnect Curitiba';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="text-center mb-5">
        <i class="bi bi-plus-circle-fill text-primary" style="font-size: 4rem;"></i>
        <h1 class="display-5 fw-bold mt-3">Criar Novo Evento</h1>
        <p class="lead text-muted">Organize um evento esportivo e encontre parceiros para jogar</p>
      </div>

      <div class="card">
        <div class="card-body p-4">
          <form action="index.php?url=post/create" method="POST">

            <div class="mb-4">
              <label for="title" class="form-label fw-semibold">
                <i class="bi bi-card-text me-2"></i>Título do Evento
              </label>
              <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Ex: Futebol no Parque Barigui - Domingo 15h" required>
              <div class="form-text">Seja específico sobre o esporte, local e horário</div>
            </div>

            <div class="mb-4">
              <label for="category_id" class="form-label fw-semibold">
                <i class="bi bi-trophy me-2"></i>Categoria Esportiva
              </label>
              <select class="form-select form-select-lg" id="category_id" name="category_id" required>
                <option value="">Selecione uma categoria</option>
                <option value="1">⚽ Futebol</option>
                <option value="2">🏀 Basquete</option>
                <option value="3">🏐 Vôlei</option>
                <option value="4">🏃 Corrida</option>
                <option value="5">🎾 Tênis</option>
                <option value="6">🏊 Natação</option>
              </select>
            </div>

            <div class="mb-4">
              <label for="description" class="form-label fw-semibold">
                <i class="bi bi-chat-quote me-2"></i>Descrição do Evento
              </label>
              <textarea class="form-control" id="description" name="description" rows="4" placeholder="Descreva o evento: nível dos jogadores, equipamentos necessários, regras especiais..." required></textarea>
              <div class="form-text">Seja claro sobre o que espera dos participantes</div>
            </div>

            <div class="mb-4">
              <label for="location" class="form-label fw-semibold">
                <i class="bi bi-geo-alt me-2"></i>Local do Evento
              </label>
              <input type="text" class="form-control" id="location" name="location" placeholder="Ex: Arena da UFPR, Quadra do Parque Barigui, Pista do Parque Tanguá" required>
              <div class="form-text">Inclua endereço completo ou ponto de referência conhecido</div>
            </div>

            <div class="row mb-4">
              <div class="col-md-6">
                <label for="event_date" class="form-label fw-semibold">
                  <i class="bi bi-calendar-event me-2"></i>Data do Evento
                </label>
                <input type="date" class="form-control" id="event_date" name="event_date" min="<?php echo date('Y-m-d'); ?>" required>
              </div>
              <div class="col-md-6">
                <label for="event_time" class="form-label fw-semibold">
                  <i class="bi bi-clock me-2"></i>Horário
                </label>
                <input type="time" class="form-control" id="event_time" name="event_time" required>
              </div>
            </div>

            <div class="mb-4">
              <label for="slots" class="form-label fw-semibold">
                <i class="bi bi-people me-2"></i>Número de Vagas
              </label>
              <input type="number" class="form-control" id="slots" name="slots" min="1" max="50" placeholder="Quantas pessoas você precisa?" required>
              <div class="form-text">Número de participantes que você está procurando</div>
            </div>

            <div class="card bg-light mb-4">
              <div class="card-body">
                <h6 class="card-title">
                  <i class="bi bi-info-circle me-2"></i>Informações Importantes
                </h6>
                <ul class="mb-0 small text-muted">
                  <li>Seu evento será visível para todos os usuários da plataforma</li>
                  <li>Você receberá notificações quando alguém se candidatar</li>
                  <li>Poderá aceitar ou recusar candidaturas conforme necessário</li>
                  <li>Participantes aceitos terão acesso aos seus dados de contato</li>
                </ul>
              </div>
            </div>

            <div class="d-flex gap-3 justify-content-end">
              <a href="index.php?url=post/list" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i>Cancelar
              </a>
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-circle me-2"></i>Criar Evento
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-body">
          <h5 class="card-title">
            <i class="bi bi-lightbulb me-2"></i>Dicas para um Evento de Sucesso
          </h5>
          <div class="row">
            <div class="col-md-6">
              <ul class="list-unstyled">
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Seja específico sobre horário e local
                </li>
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Mencione o nível de habilidade esperado
                </li>
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Informe sobre equipamentos necessários
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list-unstyled">
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Escolha locais de fácil acesso
                </li>
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Defina regras claras se necessário
                </li>
                <li class="mb-2">
                  <i class="bi bi-check-circle text-success me-2"></i>
                  Seja pontual e comunicativo
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
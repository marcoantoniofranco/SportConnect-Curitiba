<?php 
$pageTitle = 'Contato - SportConnect Curitiba';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="text-center mb-5">
        <i class="bi bi-envelope-fill text-primary" style="font-size: 4rem;"></i>
        <h1 class="display-4 fw-bold mt-3">Entre em Contato</h1>
        <p class="lead text-muted">Estamos aqui para ajudar você a se conectar com outros atletas</p>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-8 mb-4">
          <div class="card">
            <div class="card-body p-4">
              <h3 class="card-title text-primary mb-4 text-center">
                <i class="bi bi-info-circle me-2"></i>Informações de Contato
              </h3>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <h5 class="mb-2">
                    <i class="bi bi-geo-alt text-primary me-2"></i>Localização
                  </h5>
                  <p class="text-muted mb-0">Curitiba, Paraná - Brasil</p>
                  <small class="text-muted">Atendemos toda região metropolitana</small>
                </div>

                <div class="col-md-6 mb-3">
                  <h5 class="mb-2">
                    <i class="bi bi-envelope text-primary me-2"></i>E-mail
                  </h5>
                  <p class="text-muted mb-0">contato@sportconnect.com.br</p>
                  <small class="text-muted">Respondemos em até 24 horas</small>
                </div>

                <div class="col-md-6 mb-3">
                  <h5 class="mb-2">
                    <i class="bi bi-phone text-primary me-2"></i>Telefone/WhatsApp
                  </h5>
                  <p class="text-muted mb-0">(41) 99999-9999</p>
                  <small class="text-muted">Segunda a sexta, 8h às 18h</small>
                </div>

                <div class="col-md-6 mb-3">
                  <h5 class="mb-2">
                    <i class="bi bi-share text-primary me-2"></i>Redes Sociais
                  </h5>
                  <div class="d-flex gap-3">
                    <a href="#" class="text-primary fs-4" title="Facebook">
                      <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="text-primary fs-4" title="Instagram">
                      <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="text-primary fs-4" title="Twitter">
                      <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="text-primary fs-4" title="WhatsApp">
                      <i class="bi bi-whatsapp"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-body p-4">
          <h3 class="card-title text-primary mb-4">
            <i class="bi bi-question-circle me-2"></i>Perguntas Frequentes
          </h3>

          <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                  Como funciona o SportConnect?
                </button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  O SportConnect é uma plataforma onde você pode criar publicações procurando parceiros
                  para atividades esportivas ou se candidatar para participar de grupos já formados.
                  É como uma rede social focada em esportes!
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                  É gratuito para usar?
                </button>
              </h2>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Sim! O SportConnect é completamente gratuito. Você pode criar sua conta, publicar eventos
                  e participar de grupos sem nenhum custo.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                  Quais esportes posso encontrar?
                </button>
              </h2>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Temos diversas categorias: futebol, vôlei, basquete, corrida, tênis, natação e muito mais.
                  Se não encontrar seu esporte favorito, entre em contato conosco!
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                  Como posso garantir minha segurança?
                </button>
              </h2>
              <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Recomendamos sempre encontrar em locais públicos e conhecidos. Os dados de contato são
                  compartilhados apenas entre participantes aceitos nos grupos. Sempre confie no seu instinto!
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-5">
        <?php if (!isset($_SESSION['user_id'])): ?>
        <h4 class="mb-3">Ainda não faz parte da comunidade?</h4>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
          <a href="index.php?url=auth/registerForm" class="btn btn-primary btn-lg">
            <i class="bi bi-person-plus me-2"></i>Criar Conta Grátis
          </a>
          <a href="index.php?url=auth/loginForm" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-box-arrow-in-right me-2"></i>Fazer Login
          </a>
        </div>
        <?php else: ?>
        <h4 class="mb-3">Explore mais da plataforma!</h4>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
          <a href="index.php?url=post/list" class="btn btn-primary btn-lg">
            <i class="bi bi-calendar-event me-2"></i>Ver Eventos
          </a>
          <a href="index.php?url=post/create" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-plus-circle me-2"></i>Criar Evento
          </a>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
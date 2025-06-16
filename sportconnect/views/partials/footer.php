    </main>

    <footer class="bg-dark text-light py-5 mt-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <h5 class="d-flex align-items-center mb-3">
              <i class="bi bi-trophy-fill me-2 text-primary"></i>
              SportConnect Curitiba
            </h5>
            <p class="text-muted">
              Conectando atletas e entusiastas do esporte em Curitiba.
              Encontre parceiros, participe de eventos e viva o esporte!
            </p>
            <div class="d-flex gap-3">
              <a href="#" class="text-light">
                <i class="bi bi-facebook fs-5"></i>
              </a>
              <a href="#" class="text-light">
                <i class="bi bi-instagram fs-5"></i>
              </a>
              <a href="#" class="text-light">
                <i class="bi bi-twitter fs-5"></i>
              </a>
              <a href="#" class="text-light">
                <i class="bi bi-whatsapp fs-5"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 mb-4">
            <h6 class="mb-3">Navegação</h6>
            <ul class="list-unstyled">
              <li class="mb-2">
                <a href="index.php?url=home/index" class="text-muted text-decoration-none">
                  <i class="bi bi-house me-1"></i>Início
                </a>
              </li>
              <li class="mb-2">
                <a href="index.php?url=post/list" class="text-muted text-decoration-none">
                  <i class="bi bi-calendar-event me-1"></i>Eventos
                </a>
              </li>
              <li class="mb-2">
                <a href="index.php?url=home/about" class="text-muted text-decoration-none">
                  <i class="bi bi-info-circle me-1"></i>Sobre
                </a>
              </li>
              <li class="mb-2">
                <a href="index.php?url=home/contact" class="text-muted text-decoration-none">
                  <i class="bi bi-envelope me-1"></i>Contato
                </a>
              </li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 mb-4">
            <h6 class="mb-3">Esportes Populares</h6>
            <ul class="list-unstyled">
              <li class="mb-2">
                <span class="text-muted">
                  <i class="bi bi-circle-fill me-2" style="font-size: 0.5rem;"></i>Futebol
                </span>
              </li>
              <li class="mb-2">
                <span class="text-muted">
                  <i class="bi bi-circle-fill me-2" style="font-size: 0.5rem;"></i>Vôlei
                </span>
              </li>
              <li class="mb-2">
                <span class="text-muted">
                  <i class="bi bi-circle-fill me-2" style="font-size: 0.5rem;"></i>Basquete
                </span>
              </li>
              <li class="mb-2">
                <span class="text-muted">
                  <i class="bi bi-circle-fill me-2" style="font-size: 0.5rem;"></i>Corrida
                </span>
              </li>
              <li class="mb-2">
                <span class="text-muted">
                  <i class="bi bi-circle-fill me-2" style="font-size: 0.5rem;"></i>Tênis
                </span>
              </li>
            </ul>
          </div>

          <div class="col-lg-3 mb-4">
            <h6 class="mb-3">Contato</h6>
            <ul class="list-unstyled">
              <li class="mb-2 text-muted">
                <i class="bi bi-geo-alt me-2"></i>
                Curitiba, Paraná
              </li>
              <li class="mb-2 text-muted">
                <i class="bi bi-envelope me-2"></i>
                contato@sportconnect.com.br
              </li>
              <li class="mb-2 text-muted">
                <i class="bi bi-phone me-2"></i>
                (41) 99999-9999
              </li>
            </ul>
          </div>
        </div>

        <hr class="my-4 border-secondary">

        <div class="row align-items-center">
          <div class="col-md-6">
            <p class="text-muted mb-0">
              &copy; <?php echo date('Y'); ?> SportConnect Curitiba. Todos os direitos reservados.
            </p>
          </div>
          <div class="col-md-6 text-md-end">
            <small class="text-muted">
              Desenvolvido com <i class="bi bi-heart-fill text-danger"></i> para conectar atletas
            </small>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
  console.log('DOM loaded, checking Bootstrap...');

  if (typeof bootstrap === 'undefined') {
    console.error('Bootstrap não está carregado!');
    return;
  }

  console.log('Bootstrap está disponível');

  const dropdownToggles = document.querySelectorAll('[data-bs-toggle="dropdown"]');
  console.log('Encontrados ' + dropdownToggles.length + ' elementos dropdown');

  dropdownToggles.forEach(function(toggle, index) {
    console.log('Inicializando dropdown ' + (index + 1) + ':', toggle);

    try {
      const dropdown = new bootstrap.Dropdown(toggle);
      console.log('Dropdown ' + (index + 1) + ' inicializado com sucesso');

      toggle.addEventListener('click', function(e) {
        console.log('Dropdown clicado!');
      });

    } catch (error) {
      console.error('Erro ao inicializar dropdown ' + (index + 1) + ':', error);
    }
  });

  setTimeout(function() {
    const userDropdown = document.getElementById('userDropdown');
    if (userDropdown) {
      console.log('Elemento userDropdown encontrado:', userDropdown);
      console.log('Classes do elemento:', userDropdown.className);
      console.log('Atributos data-bs:', userDropdown.getAttribute('data-bs-toggle'));
    } else {
      console.log('Elemento userDropdown NÃO encontrado!');
    }
  }, 500);
});
    </script>
    </body>

    </html>
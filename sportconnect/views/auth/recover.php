<?php 
$pageTitle = 'Recuperar Senha - SportConnect Curitiba';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="bi bi-key-fill text-primary" style="font-size: 3rem;"></i>
                    <h2 class="mt-3 mb-1">Recuperar Senha</h2>
                    <p class="text-muted">Digite seus dados para validação</p>
                </div>

                <form method="POST" action="index.php?url=auth/recoverPassword">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                    
                    <div class="mb-3">
                        <label for="cpf" class="form-label">
                            <i class="bi bi-card-text me-1"></i>CPF
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg" 
                               id="cpf" 
                               name="cpf" 
                               placeholder="000.000.000-00"
                               required>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Digite o CPF cadastrado na sua conta
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="birth_date" class="form-label">
                            <i class="bi bi-calendar me-1"></i>Data de Nascimento
                        </label>
                        <input type="date" 
                               class="form-control form-control-lg" 
                               id="birth_date" 
                               name="birth_date" 
                               required>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Digite sua data de nascimento
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-search me-2"></i>Validar Dados
                        </button>
                    </div>

                    <div class="text-center">
                        <small class="text-muted">
                            <i class="bi bi-shield-check me-1"></i>
                            Seus dados são protegidos e verificados com segurança
                        </small>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <p class="text-muted">
                Lembrou da senha? 
                <a href="index.php?url=auth/loginForm" class="text-primary text-decoration-none fw-semibold">
                    Faça login aqui
                </a>
            </p>
            <p class="text-muted">
                Não tem uma conta? 
                <a href="index.php?url=auth/registerForm" class="text-primary text-decoration-none fw-semibold">
                    Cadastre-se aqui
                </a>
            </p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
<?php 
$pageTitle = 'Cadastro - SportConnect Curitiba';
include __DIR__ . '/../partials/header.php'; 
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="bi bi-person-plus-fill text-primary" style="font-size: 3rem;"></i>
                    <h2 class="mt-3 mb-1">Junte-se ao SportConnect!</h2>
                    <p class="text-muted">Crie sua conta e conecte-se com outros atletas</p>
                </div>

                <?php
                if (isset($_SESSION['error_message'])) {
                    echo '<p>' . htmlspecialchars($_SESSION['error_message']) . '</p>';
                    unset($_SESSION['error_message']);
                }
                if (isset($_SESSION['success_message'])) {
                    echo '<p>' . htmlspecialchars($_SESSION['success_message']) . '</p>';
                    unset($_SESSION['success_message']);
                }
                ?>

                <form method="POST" action="index.php?url=auth/register">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-person me-1"></i>Nome Completo
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Seu nome completo"
                                   required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-1"></i>E-mail
                            </label>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   placeholder="seu@email.com"
                                   required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">
                                <i class="bi bi-phone me-1"></i>Telefone/WhatsApp
                            </label>
                            <input type="tel" 
                                   class="form-control" 
                                   id="phone" 
                                   name="phone" 
                                   placeholder="(41) 99999-9999"
                                   required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="cpf" class="form-label">
                                <i class="bi bi-card-text me-1"></i>CPF
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="cpf" 
                                   name="cpf" 
                                   placeholder="000.000.000-00"
                                   required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="birth_date" class="form-label">
                            <i class="bi bi-calendar me-1"></i>Data de Nascimento
                        </label>
                        <input type="date" 
                               class="form-control" 
                               id="birth_date" 
                               name="birth_date" 
                               required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock me-1"></i>Senha
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Mínimo 6 caracteres"
                                   required>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label for="confirm_password" class="form-label">
                                <i class="bi bi-lock-fill me-1"></i>Confirmar Senha
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="confirm_password" 
                                   name="confirm_password" 
                                   placeholder="Digite novamente"
                                   required>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-person-plus me-2"></i>Criar Conta
                        </button>
                    </div>

                    <div class="text-center">
                        <small class="text-muted">
                            Ao criar uma conta, você concorda com nossos 
                            <a href="#" class="text-primary">Termos de Uso</a> e 
                            <a href="#" class="text-primary">Política de Privacidade</a>
                        </small>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <p class="text-muted">
                Já tem uma conta? 
                <a href="index.php?url=auth/loginForm" class="text-primary text-decoration-none fw-semibold">
                    Faça login aqui
                </a>
            </p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
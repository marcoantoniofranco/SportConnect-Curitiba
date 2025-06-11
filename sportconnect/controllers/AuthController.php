<?php
class AuthController {
    public function login() {
        require __DIR__ . "/../views/auth/login.php";
    }

    public function register() {
        require __DIR__ . "/../views/auth/register.php";
    }

    public function recover() {
        require __DIR__ . "/../views/auth/recover.php";
    }
}
?>
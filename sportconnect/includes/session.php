<?php

session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function setUserSession($userId) {
    $_SESSION['user_id'] = $userId;
    if (isset($_POST['remember_me'])) {
        // Implementar cookies para "lembrar login"
        setcookie('remember_user', $userId, time() + (86400 * 30), '/');
    }
}

function logout() {
    session_destroy();
    setcookie('remember_user', '', time() - 3600, '/');
}
?>
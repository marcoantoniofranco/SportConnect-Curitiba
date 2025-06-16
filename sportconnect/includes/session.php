<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function setUserSession($userId) {
    $_SESSION['user_id'] = $userId;
}

function logout() {
    session_destroy();
}
?>
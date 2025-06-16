<?php
class HomeController {
    public function index() {
        require __DIR__ . "/../views/home.php";
    }

    public function sobre() {
        require __DIR__ . "/../views/home/about.php";
    }

    public function contato() {
        require __DIR__ . "/../views/home/contact.php";
    }
}
?>
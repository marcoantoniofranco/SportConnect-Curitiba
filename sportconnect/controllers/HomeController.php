<?php
class HomeController {
    public function index() {
        require __DIR__ . "/../views/home/index.php";
    }

    public function about() {
        require __DIR__ . "/../views/home/about.php";
    }

    public function contact() {
        require __DIR__ . "/../views/home/contact.php";
    }

    public function sobre() {
        $this->about();
    }

    public function contato() {
        $this->contact();
    }
}
?>
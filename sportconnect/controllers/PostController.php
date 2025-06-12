<?php

class PostController {
    private $db;
    private $user;

    public function __construct() {
        $this->db = new Database();
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
        $this->user = new User();
        $this->user->findById($_SESSION['user_id']);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate CSRF token
            if (!validateCSRFToken($_POST['csrf_token'])) {
                $_SESSION['error'] = 'Invalid form submission';
                header('Location: /posts/create');
                exit();
            }

            // Validate required fields
            $required_fields = ['title', 'description', 'location', 'event_date', 'slots', 'category_id'];
            foreach ($required_fields as $field) {
                if (empty($_POST[$field])) {
                    $_SESSION['error'] = 'All fields are required';
                    header('Location: /posts/create');
                    exit();
                }
            }

            // Create new post
            $post = new Post();
            $post->setUserId($_SESSION['user_id']);
            $post->setCategoryId($_POST['category_id']);
            $post->setTitle($_POST['title']);
            $post->setDescription($_POST['description']);
            $post->setLocation($_POST['location']);
            $post->setEventDate($_POST['event_date']);
            $post->setSlots($_POST['slots']);

            if ($post->save()) {
                $_SESSION['success'] = 'Post created successfully';
                header('Location: /posts');
                exit();
            } else {
                $_SESSION['error'] = 'Error creating post';
                header('Location: /posts/create');
                exit();
            }
        }

        // Get categories for the form
        $category = new Category();
        $categories = $category->findAll();
        
        require_once 'views/posts/create.php';
    }

    public function edit($id) {
        $post = new Post();
        $post->findById($id);

        // Check if post exists and belongs to user
        if (!$post->getId() || $post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error'] = 'Post not found or unauthorized';
            header('Location: /posts');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate CSRF token
            if (!validateCSRFToken($_POST['csrf_token'])) {
                $_SESSION['error'] = 'Invalid form submission';
                header('Location: /posts/edit/' . $id);
                exit();
            }

            // Validate required fields
            $required_fields = ['title', 'description', 'location', 'event_date', 'slots', 'category_id'];
            foreach ($required_fields as $field) {
                if (empty($_POST[$field])) {
                    $_SESSION['error'] = 'All fields are required';
                    header('Location: /posts/edit/' . $id);
                    exit();
                }
            }

            // Update post
            $post->setCategoryId($_POST['category_id']);
            $post->setTitle($_POST['title']);
            $post->setDescription($_POST['description']);
            $post->setLocation($_POST['location']);
            $post->setEventDate($_POST['event_date']);
            $post->setSlots($_POST['slots']);

            if ($post->update()) {
                $_SESSION['success'] = 'Post updated successfully';
                header('Location: /posts');
                exit();
            } else {
                $_SESSION['error'] = 'Error updating post';
                header('Location: /posts/edit/' . $id);
                exit();
            }
        }

        // Get categories for the form
        $category = new Category();
        $categories = $category->findAll();
        
        require_once 'views/posts/edit.php';
    }

    public function delete($id) {
        $post = new Post();
        $post->findById($id);

        // Check if post exists and belongs to user
        if (!$post->getId() || $post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error'] = 'Post not found or unauthorized';
            header('Location: /posts');
            exit();
        }

        if ($post->delete()) {
            $_SESSION['success'] = 'Post deleted successfully';
        } else {
            $_SESSION['error'] = 'Error deleting post';
        }

        header('Location: /posts');
        exit();
    }

    public function list() {
        $post = new Post();
        $posts = $post->findAll();
        require_once 'views/posts/list.php';
    }

    public function view($id) {
        $post = new Post();
        $post->findById($id);

        if (!$post->getId()) {
            $_SESSION['error'] = 'Post not found';
            header('Location: /posts');
            exit();
        }

        // Get post author
        $author = new User();
        $author->findById($post->getUserId());

        // Get category
        $category = new Category();
        $category->findById($post->getCategoryId());

        // Get participations
        $participation = new Participation();
        $participations = $participation->findByPostId($id);

        require_once 'views/posts/view.php';
    }
} 
<?php

class ParticipationController {
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

    public function apply($post_id) {
        // Validate CSRF token
        if (!validateCSRFToken($_POST['csrf_token'])) {
            $_SESSION['error'] = 'Invalid form submission';
            header('Location: /posts/view/' . $post_id);
            exit();
        }

        // Check if post exists
        $post = new Post();
        $post->findById($post_id);
        
        if (!$post->getId()) {
            $_SESSION['error'] = 'Post not found';
            header('Location: /posts');
            exit();
        }

        // Check if user is not the post owner
        if ($post->getUserId() === $_SESSION['user_id']) {
            $_SESSION['error'] = 'You cannot apply to your own post';
            header('Location: /posts/view/' . $post_id);
            exit();
        }

        // Check if user already applied
        $participation = new Participation();
        if ($participation->findByUserAndPost($_SESSION['user_id'], $post_id)) {
            $_SESSION['error'] = 'You have already applied to this post';
            header('Location: /posts/view/' . $post_id);
            exit();
        }

        // Create new participation
        $participation = new Participation();
        $participation->setPostId($post_id);
        $participation->setUserId($_SESSION['user_id']);
        $participation->setStatus('pending');

        if ($participation->save()) {
            $_SESSION['success'] = 'Application submitted successfully';
        } else {
            $_SESSION['error'] = 'Error submitting application';
        }

        header('Location: /posts/view/' . $post_id);
        exit();
    }

    public function respond($participation_id, $status) {
        // Validate CSRF token
        if (!validateCSRFToken($_POST['csrf_token'])) {
            $_SESSION['error'] = 'Invalid form submission';
            header('Location: /posts');
            exit();
        }

        // Validate status
        if (!in_array($status, ['accepted', 'rejected'])) {
            $_SESSION['error'] = 'Invalid status';
            header('Location: /posts');
            exit();
        }

        // Get participation
        $participation = new Participation();
        $participation->findById($participation_id);

        if (!$participation->getId()) {
            $_SESSION['error'] = 'Participation not found';
            header('Location: /posts');
            exit();
        }

        // Get post
        $post = new Post();
        $post->findById($participation->getPostId());

        // Check if user is post owner
        if ($post->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['error'] = 'Unauthorized';
            header('Location: /posts');
            exit();
        }

        // Update participation status
        $participation->setStatus($status);
        
        if ($participation->update()) {
            $_SESSION['success'] = 'Participation ' . $status . ' successfully';
        } else {
            $_SESSION['error'] = 'Error updating participation';
        }

        header('Location: /posts/view/' . $post->getId());
        exit();
    }
} 
<?php require_once 'views/includes/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Sport Events</h2>
        <a href="/posts/create" class="btn btn-primary">Create New Post</a>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (empty($posts)): ?>
        <div class="alert alert-info">
            No posts found. Be the first to create one!
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($posts as $post): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($post->getTitle()); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?php 
                                $category = new Category();
                                $category->findById($post->getCategoryId());
                                echo htmlspecialchars($category->getName());
                                ?>
                            </h6>
                            <p class="card-text">
                                <?php 
                                $description = $post->getDescription();
                                echo strlen($description) > 100 ? htmlspecialchars(substr($description, 0, 100)) . '...' : htmlspecialchars($description);
                                ?>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($post->getLocation()); ?><br>
                                    <i class="fas fa-calendar"></i> <?php echo date('M d, Y H:i', strtotime($post->getEventDate())); ?><br>
                                    <i class="fas fa-users"></i> <?php echo $post->getSlots(); ?> slots available
                                </small>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="/posts/view/<?php echo $post->getId(); ?>" class="btn btn-primary btn-sm">View Details</a>
                            <?php if ($post->getUserId() === $_SESSION['user_id']): ?>
                                <a href="/posts/edit/<?php echo $post->getId(); ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="/posts/delete/<?php echo $post->getId(); ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'views/includes/footer.php'; ?> 
<?php require_once 'views/includes/header.php'; ?>

<div class="container mt-4">
    <h2>Create New Post</h2>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <form action="/posts/create" method="POST" class="mt-4">
        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Sport Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Select a category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category->getId(); ?>">
                        <?php echo htmlspecialchars($category->getName()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>

        <div class="mb-3">
            <label for="event_date" class="form-label">Event Date and Time</label>
            <input type="datetime-local" class="form-control" id="event_date" name="event_date" required>
        </div>

        <div class="mb-3">
            <label for="slots" class="form-label">Available Slots</label>
            <input type="number" class="form-control" id="slots" name="slots" min="1" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Create Post</button>
            <a href="/posts" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'views/includes/footer.php'; ?> 
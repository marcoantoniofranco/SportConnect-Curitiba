<?php require_once 'views/includes/header.php'; ?>

<div class="container mt-4">
    <h2>Edit Post</h2>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <form action="/posts/edit/<?php echo $post->getId(); ?>" method="POST" class="mt-4">
        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post->getTitle()); ?>" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Sport Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Select a category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category->getId(); ?>" <?php echo $category->getId() === $post->getCategoryId() ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category->getName()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($post->getDescription()); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($post->getLocation()); ?>" required>
        </div>

        <div class="mb-3">
            <label for="event_date" class="form-label">Event Date and Time</label>
            <input type="datetime-local" class="form-control" id="event_date" name="event_date" value="<?php echo date('Y-m-d\TH:i', strtotime($post->getEventDate())); ?>" required>
        </div>

        <div class="mb-3">
            <label for="slots" class="form-label">Available Slots</label>
            <input type="number" class="form-control" id="slots" name="slots" min="1" value="<?php echo $post->getSlots(); ?>" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Update Post</button>
            <a href="/posts/view/<?php echo $post->getId(); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'views/includes/footer.php'; ?> 
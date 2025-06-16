<?php 
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../includes/csrf.php";
?>

<div class="container mt-4">
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

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h2 class="card-title"><?php echo htmlspecialchars($post->getTitle()); ?></h2>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?php echo htmlspecialchars($category->getName()); ?>
                    </h6>
                </div>
                <?php if ($post->getUserId() === $_SESSION['user_id']): ?>
                    <div>
                        <a href="/posts/edit/<?php echo $post->getId(); ?>" class="btn btn-secondary">Edit</a>
                        <form action="/posts/delete/<?php echo $post->getId(); ?>" method="POST" class="d-inline">
                            <input type="hidden" name="csrf_token" value="<?php echo gerarTokenCSRF(); ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Event Details</h5>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> <strong>Location:</strong><br>
                        <?php echo htmlspecialchars($post->getLocation()); ?>
                    </p>
                    <p>
                        <i class="fas fa-calendar"></i> <strong>Date and Time:</strong><br>
                        <?php echo date('F d, Y H:i', strtotime($post->getEventDate())); ?>
                    </p>
                    <p>
                        <i class="fas fa-users"></i> <strong>Available Slots:</strong><br>
                        <?php echo $post->getSlots(); ?> slots
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Organizer</h5>
                    <p>
                        <i class="fas fa-user"></i> <strong>Name:</strong><br>
                        <?php echo htmlspecialchars($author->getName()); ?>
                    </p>
                    <p>
                        <i class="fas fa-envelope"></i> <strong>Email:</strong><br>
                        <?php echo htmlspecialchars($author->getEmail()); ?>
                    </p>
                    <?php if ($author->getWhatsapp()): ?>
                        <p>
                            <i class="fab fa-whatsapp"></i> <strong>WhatsApp:</strong><br>
                            <?php echo htmlspecialchars($author->getWhatsapp()); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mb-4">
                <h5>Description</h5>
                <p class="card-text"><?php echo nl2br(htmlspecialchars($post->getDescription())); ?></p>
            </div>

            <?php if ($post->getUserId() !== $_SESSION['user_id']): ?>
                <div class="mb-4">
                    <h5>Interested in participating?</h5>
                    <form action="/participation/apply/<?php echo $post->getId(); ?>" method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo gerarTokenCSRF(); ?>">
                        <button type="submit" class="btn btn-primary">Apply to Participate</button>
                    </form>
                </div>
            <?php endif; ?>

            <?php if ($post->getUserId() === $_SESSION['user_id'] && !empty($participations)): ?>
                <div class="mt-4">
                    <h5>Participation Requests</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($participations as $participation): 
                                    $participant = new User();
                                    $participant->findById($participation->getUserId());
                                ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($participant->getName()); ?></td>
                                        <td><?php echo htmlspecialchars($participant->getEmail()); ?></td>
                                        <td>
                                            <span class="badge bg-<?php 
                                                echo $participation->getStatus() === 'pending' ? 'warning' : 
                                                    ($participation->getStatus() === 'accepted' ? 'success' : 'danger'); 
                                            ?>">
                                                <?php echo ucfirst($participation->getStatus()); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($participation->getStatus() === 'pending'): ?>
                                                <form action="/participation/respond/<?php echo $participation->getId(); ?>/accepted" method="POST" class="d-inline">
                                                    <input type="hidden" name="csrf_token" value="<?php echo gerarTokenCSRF(); ?>">
                                                    <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                                </form>
                                                <form action="/participation/respond/<?php echo $participation->getId(); ?>/rejected" method="POST" class="d-inline">
                                                    <input type="hidden" name="csrf_token" value="<?php echo gerarTokenCSRF(); ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-4">
        <a href="/posts" class="btn btn-secondary">Back to Posts</a>
    </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?> 
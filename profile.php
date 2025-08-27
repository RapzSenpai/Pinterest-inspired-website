<?php
include 'views/header.php';
?>

<div class="profile-card">
    <div class="profile-image">
        <img src="uploads/bg.jpg" alt="Profile Picture">
    </div>
    <div class="profile-info">
    <p><strong>Firstname:</strong> <?php echo $_SESSION['firstname'] ?? ''; ?></p>
    <p><strong>Lastname:</strong> <?php echo $_SESSION['lastname'] ?? ''; ?></p>


    
</div>

</div>

<?php
include 'views/footer.php';
?>

<?php
include 'views/header.php';

if (!isset($_SESSION['uid'])) {
    echo '
    <div class="pinterest-hero">
        <h1>Welcome to <span class="highlight">RJDPinHub</span></h1>
        <p>Discover and share ideas you love</p>
    </div>
    <div class="pinterest-grid">
        <div class="pin"><img src="uploads/1.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/2.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/3.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/4.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/art.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/memes.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/tarong.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/amigas.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/sarap.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/fafa.jpg" alt="Idea 1"></div>
        <div class="pin"><img src="uploads/jay.jpg" alt="Idea 2"></div>
        <div class="pin"><img src="uploads/rapz.jpg" alt="Idea 3"></div>
        <div class="pin"><img src="uploads/papi.jpg" alt="Idea 4"></div>
        <div class="pin"><img src="uploads/boy.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/memes1.jpg" alt="Idea 5"></div>
        <div class="pin"><img src="uploads/dadi.jpg" alt="Idea 5"></div>
        
    </div>';
} else {
    include 'views/view_posts.php';
}

include 'views/footer.php';
?>

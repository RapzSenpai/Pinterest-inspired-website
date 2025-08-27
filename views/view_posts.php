<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require "models/dbconnection.php";
$con = create_connection();

if ($con->connect_error) {
    die("Connection Failed");
}
?>

<form action="models/create_post.php" method="POST" enctype="multipart/form-data" class="post-form">
    <textarea name="post_content" placeholder="What's on your mind?" required></textarea><br>
    <div class="custom-file-upload">
    <label for="post_image" class="file-label">📁 Choose Image</label>
    <input type="file" name="post_image" id="post_image" accept="image/*" class="file-input">
    </div>

    <button type="submit">Post</button>
</form>


<?php
$sql_posts = "SELECT user.firstname, user.lastname, post.text_content, post.date, post.time, post.pid, post.uid
              FROM post
              INNER JOIN user ON user.uid = post.uid
              ORDER BY post.pid DESC";

$result_posts = $con->query($sql_posts);

while ($row = $result_posts->fetch_assoc()) {
    $pid = $row['pid'];
    // Get comment count
    $sql_count = "SELECT COUNT(*) AS total_comments FROM comment WHERE pid = $pid";
    $result_count = $con->query($sql_count);
    $row_count = $result_count->fetch_assoc();
    $total_comments = $row_count['total_comments'];

    ?>


    <div class="post">
        <div class="post_name">
            <?= htmlspecialchars($row['firstname']) . " " . htmlspecialchars($row['lastname']); ?>
            &nbsp;&nbsp;<span><?= $row['date'] . " • " . date("g:i A", strtotime($row['time'])); ?></span>
        </div>

        <div class="post_content">
            <?= htmlspecialchars($row['text_content']); ?>
        </div>
        <?php

    $sql_image = "SELECT filename FROM images WHERE pid = $pid LIMIT 1";
    $result_image = $con->query($sql_image);

    if ($result_image && $result_image->num_rows > 0) {
        $image = $result_image->fetch_assoc();
        $imagePath = 'uploads/' . htmlspecialchars($image['filename']);
        echo "<div class='post_image'><img src='$imagePath' alt='Post image'></div>";
    }
        ?>  


        <?php if ($_SESSION['uid'] === $row['uid']) : ?>
            <div class="post_actions">
                <form action="edit.php" method="GET" style="display:inline;">
                    <input type="hidden" name="pid" value="<?= $pid; ?>">
                    <button type="submit">Edit</button>
                </form>
                <form action="models/delete_post.php" method="POST" style="display:inline; margin-left: 10px;">
                    <input type="hidden" name="pid" value="<?= $pid; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?');">Delete</button>
                </form>
            </div>
        <?php endif; ?>

        <button class="comment-btn" onclick="toggleCommentBox('comment-box-<?= $pid; ?>')">
    💬 Comment (<?= $total_comments; ?>)
    </button>


        <div class="comment-box" id="comment-box-<?= $pid; ?>" style="display:none;">
            <form action="models/add_comment.php" method="POST">
                <input type="hidden" name="pid" value="<?= $pid; ?>">
                <textarea name="comment_text" placeholder="Write a comment..." required></textarea><br>
                <button type="submit">Post Comment</button>
            </form>

            <?php
            $sql_comments = "SELECT comment.*, user.firstname, user.lastname 
                             FROM comment 
                             INNER JOIN user ON user.uid = comment.uid 
                             WHERE comment.pid = $pid 
                             ORDER BY comment.cid DESC";

            $result_comments = $con->query($sql_comments);

            while ($comment = $result_comments->fetch_assoc()) :
            ?>
                <div class="comment">
                    <div class="comment_header">
                        <strong><?= htmlspecialchars($comment['firstname'] . " " . $comment['lastname']); ?></strong>
                        <span class="comment_time"> ‎ ‎ ‎ <?= $comment['date'] . " • " . date("g:i A", strtotime($comment['time'])); ?></span>
                    </div>
                    <div class="comment_body">
                        <?= htmlspecialchars($comment['comment_text']); ?>
                    </div>

                    <?php if ($_SESSION['uid'] === $comment['uid']) : ?>
                        <div class="comment_actions">
                            <form action="edit_comment.php" method="GET" style="display:inline;">
                                <input type="hidden" name="cid" value="<?= $comment['cid']; ?>">
                                <button type="submit" class="comment-edit-btn">Edit</button>
                            </form>
                            <form action="models/delete_comment.php" method="POST" style="display:inline;">
                                <input type="hidden" name="cid" value="<?= $comment['cid']; ?>">
                                <button type="submit" class="comment-delete-btn" onclick="return confirm('Delete this comment?')">Delete</button>
                            </form>
                          

                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div><br>

<?php
}
?>

<script>
function toggleCommentBox(id) {
    var box = document.getElementById(id);
    box.style.display = (box.style.display === 'none') ? 'block' : 'none';
}
</script>
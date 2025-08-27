<link rel="stylesheet" type="text/css" href="res/mystyle.css">
<?php
require "models/dbconnection.php";
$con = create_connection();

$pid = $_GET['pid'] ?? 0;

$stmt = $con->prepare("SELECT text_content FROM post WHERE pid = ?");
$stmt->bind_param("i", $pid);
$stmt->execute();
$stmt->bind_result($content);
$stmt->fetch();
$stmt->close();
?>

<form action="models/edit_post.php" method="POST" class="edit-form">
    <input type="hidden" name="pid" value="<?= $pid ?>">
    <textarea name="new_content" required><?= htmlspecialchars($content) ?></textarea><br>
    <button type="submit">Update Post</button>
</form>

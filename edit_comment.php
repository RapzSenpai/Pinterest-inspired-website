<link href="./res/mystyle.css" rel="stylesheet" type="text/css"/>
<?php
session_start();
require "models/dbconnection.php";
$con = create_connection();

if ($con->connect_error) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cid"])) {
    $cid = $_GET["cid"];
    $sql = "SELECT comment_text FROM comment WHERE cid = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $comment_text = $row["comment_text"];
    } else {
        echo "Comment not found.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cid"])) {
    $cid = $_POST["cid"];
    $updated_text = $_POST["comment_text"];

    $sql = "UPDATE comment SET comment_text = ?, date = CURDATE(), time = CURTIME() WHERE cid = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $updated_text, $cid);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>


<div class="edit-comment-form">
<!--    <h2>Edit Comment</h2>-->
    <form method="POST" action="edit_comment.php">
        <input type="hidden" name="cid" value="<?php echo $cid; ?>">
        <textarea name="comment_text" required><?php echo htmlspecialchars($comment_text); ?></textarea><br>
        <button type="submit">Update Comment</button>
    </form>
</div>


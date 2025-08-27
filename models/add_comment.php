<?php
session_start();
require "dbconnection.php";

if (!isset($_SESSION['uid'])) {
    die("Unauthorized");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pid'], $_POST['comment_text'])) {
    $pid = $_POST['pid'];
    $uid = $_SESSION['uid'];
    $comment_text = trim($_POST['comment_text']);

    if (!empty($comment_text)) {
        $con = create_connection();

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $stmt = $con->prepare("INSERT INTO comment (pid, uid, comment_text, date, time) VALUES (?, ?, ?, CURDATE(), CURTIME())");
        $stmt->bind_param("iis", $pid, $uid, $comment_text);
        $stmt->execute();
        $stmt->close();
        $con->close();
    }
}

header("Location: ../index.php");
exit;
?>

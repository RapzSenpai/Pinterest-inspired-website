<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "dbconnection.php";
$con = create_connection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uid = $_SESSION['uid'];
    $text = $_POST['post_content'];
    $date = date("Y-m-d");
    $time = date("H:i:s");

    // Insert text content
    $stmt = $con->prepare("INSERT INTO post (uid, text_content, date, time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $uid, $text, $date, $time);
    $stmt->execute();
    $pid = $stmt->insert_id;
    $stmt->close();

    // Handle image if uploaded
    if (!empty($_FILES['post_image']['name'])) {
        $imageName = basename($_FILES["post_image"]["name"]);
        $targetDir = "../uploads/";
        $targetFile = $targetDir . $imageName;
        move_uploaded_file($_FILES["post_image"]["tmp_name"], $targetFile);

        $stmt_img = $con->prepare("INSERT INTO images (pid, filename) VALUES (?, ?)");
        $stmt_img->bind_param("is", $pid, $imageName);
        $stmt_img->execute();
        $stmt_img->close();
    }

   
    header("Location: ../index.php");
    exit();
}
?>

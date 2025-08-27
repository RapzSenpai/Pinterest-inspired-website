<?php
require "dbconnection.php";
$con = create_connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = $_POST['pid'];
    $new_content = $_POST['new_content'];

    $stmt = $con->prepare("UPDATE post SET text_content = ? WHERE pid = ?");
    $stmt->bind_param("si", $new_content, $pid);
    $stmt->execute();
    $stmt->close();
}

$con->close();
header("Location: ../index.php");
exit();
?>

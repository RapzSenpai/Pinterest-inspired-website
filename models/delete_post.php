<?php
require "dbconnection.php";
$con = create_connection();

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];

    $stmt = $con->prepare("DELETE FROM post WHERE pid = ?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();

    $stmt->close();
}

$con->close();
header("Location: ../index.php"); // Redirect back
exit();
?>

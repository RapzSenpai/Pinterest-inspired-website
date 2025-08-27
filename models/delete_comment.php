<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require "dbconnection.php";
$con = create_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cid"])) {
    $cid = $_POST["cid"];

    $sql = "DELETE FROM comment WHERE cid = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $cid);
    $stmt->execute();
}

header("Location: ../index.php");
exit;

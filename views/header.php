<?php
session_start();
?>

<!DOCTYPE html>

<html>
     <head>
          <meta charset = "UTF-8">
          <title>RJDPinHub</title>
          <link href="./res/mystyle.css" rel="stylesheet" type="text/css"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="navbar">
            <a href="./index.php">Home</a>
            
            <a href="./about.php">About</a>
            <?php
            if(isset($_SESSION['uid'])){
            ?> 
                <a href="./profile.php"><?php echo $_SESSION['username'];?></a>
                <a href="./models/logout.php">Logout</a>
            <?php
            }
            else{
            ?>           
                <a href="./login.php">Log In</a> 
                <a href="./registration.php">Register</a>
            <?php
            }
            ?>
        </div>

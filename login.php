<?php
include 'views/header.php';
?>

<form id="loginform" action="models/login_user.php" method="POST"> 
    <?php
    if(isset($_GET['regsuccess'])){
        if($_GET['regsuccess']==1){
             echo "<div class='success_message'>Registration Success</div>";
        }
    }
    ?>
    <label for="uname">Username or Email</label>
    <input type="text" name="uname" id="uname" placeholder="username or email" required>
    <label for="pass">Password</label>
    <input type="password" name="pass" id="pass" placeholder="password" required>
    <input type="submit" value="Log in">
    <p>Don't have an account?</p>
    <a href="./registration.php">register</a>
</form>

<?php       
include 'views/footer.php';       
?>
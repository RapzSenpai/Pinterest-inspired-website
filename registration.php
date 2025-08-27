<?php

include 'views/header.php';
?>

<div></div>

<form id="loginform" action="models/register_user.php" method="POST"> 
    <div class="header">REGISTRATION</div>
    
    <?php
    
    if(isset($_GET['uname_error'])){
        if ($_GET['uname_error']==1){
            echo "<div class='error_message'>Invalid username</div>";
        }
    }
    ?>
    
    
    <label for="uname">Username or Email</label>
    <input type="text" name="uname" id="uname" placeholder="username or email" required>
    <?php
    if(isset($_GET['email_error'])){
        if($_GET['email_error']==1){
            echo "<div class='error_message'>Invalid Email</div>";
        }
    }
    ?>
    <label for="fname">First Name</label>
    <input type="text" name="fname" id="fname" placeholder="First name" required>
    <label for="lname">Last Name</label>
    <input type="text" name="lname" id="lname" placeholder="Last name" required>
    <label for="email">Email</label>
    <input type="email" name ="email" placeholder="Email" required>
    
    <div>
        <label for="gender">Gender</label>
        <select name="gender" id="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="prefer not">Prefer Not To Say</option>

        </select>
    </div>
    
    <label for="bdate">Birth date</label>
    <input type="date" name="bdate" id="bdate" required>
    <label for="pass">Password</label>
    <input type="password" name="pass" id="pass" placeholder="password" required>
    <label for="pass">Confirm Password</label>
    <input type="password" name="conpass" id="conpass" placeholder="confirm password" required>
    <div  id="eula-div">
        <input type="checkbox" name="eulabox" id="eulabox" value="eulabox">
        <a href="#" >Terms and Condition</a>
    </div>
    
    <input type="submit" value="Register">
    
    
</form>


<?php
include 'views/footer.php';
        
?>
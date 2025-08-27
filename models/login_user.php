    <?php

    session_start();


    require "dbconnection.php";

    $un = htmlspecialchars($_POST['uname']);
    $pass = htmlspecialchars($_POST['pass']);

    $con=create_connection();

    if($con->connect_error){
        die("Connection Failed");
    }

    //check username availabilty
    $uname_error=0;

    $sql_uname="SELECT * FROM user WHERE username='$un' AND password='$pass'";

    $result_uname=$con->query($sql_uname);

    if($result_uname->num_rows==1){
    $row = $result_uname->fetch_assoc();
    $_SESSION['uid'] = $row['uid'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['em'] = $row['email'];
    $_SESSION['gender'] = $row['gender'];


    echo $username." ".$firstname." ".$lastname;
}

    header("location:../index.php");
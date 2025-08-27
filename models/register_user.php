<?php

require "dbconnection.php";

$un = htmlspecialchars($_POST['uname']);
$fn = htmlspecialchars($_POST['fname']);
$ln = htmlspecialchars($_POST['lname']);
$em = htmlspecialchars($_POST['email']);
$gndr = htmlspecialchars($_POST['gender']);
$bdate = htmlspecialchars($_POST['bdate']);
$pass = htmlspecialchars($_POST['pass']);
$conpass = htmlspecialchars($_POST['conpass']);

echo "Username: " .$un."<br>";
echo "Email: " .$em."<br>";
echo "Fistname: " .$fn."<br>";
echo "Lastname: " .$ln."<br>";
echo "Gender: " .$gndr."<br>";
echo "Birthdate: " .date('Y-m-d', strtotime($bdate))."<br>";
echo "Password: " .$pass."<br>";
echo "Confirm Password: " .$conpass."<br>";

$con=create_connection();

if($con->connect_error){
    die("Connection Failed");
}
//check username availabilty
$uname_error=0;
$sql_uname="SELECT * FROM user WHERE username='$un'";
$result=$con->query($sql_uname);

if($result->num_rows>0){
    $uname_error=1;
}

//email
$email_error=0;
$sql_email="SELECT * FROM user WHERE email='$em'";
$result=$con->query($sql_email);
if($result->num_rows>0){
    $email_error=1;
}

//check confirm password
$pass_match=strcmp($pass,$conpass);

//register if no errors in credentials
if($pass_match===0 && $uname_error == 0){

$sql_insert = "INSERT INTO user (username, firstname, lastname, email, password, gender, bdate)
               VALUES ('$un', '$fn', '$ln', '$em', '$pass', '$gndr', '$bdate')";


$con->query($sql_insert);
header("location:../login.php?regsuccess=1");

}
else{
    //echo "Invalid Credentials";
    header("location:../registration.php?uname_error=".$uname_error."&email_error".$email_error);
}
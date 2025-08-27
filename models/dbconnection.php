<?php

function create_connection(){
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "socmed_rapz";
    
    return new mysqli($host,$username,$password,$database);
}
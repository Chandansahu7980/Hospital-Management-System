<?php

$host="localhost";
$user="root";
$password="";
$db="projecthms";

$conn=new mysqli($host,$user,$password,$db);
if($conn->connect_error){
    echo "database connection failed";
    die("Connection failed ".$conn->error);
}else{
    // echo "connection to database successful";
}
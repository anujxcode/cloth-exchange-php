<?php 
$host = "localhost";
$username ="root";
$password ="";
$db = "clothexchange";

$conn = new mysqli($host,$username,$password,$db);
if($conn){
    $conn_message = "connected";
}
else{
    die("not connected");
}
?>
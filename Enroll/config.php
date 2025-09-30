<?php
  session_start();

  $servername = "localhost";
  $username = "root";
  $password = " "; //add ur password if u have it hereeee!!!!!!! **Don't ask me again gif**
  $db   = "enroll";

  $conn = new mysqli($servername,$username,$password,$db);

  if($conn->connect_error){
    die("Connection Failed : " . $conn->connect_error);
  }
?>
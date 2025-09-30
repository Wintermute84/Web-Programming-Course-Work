<?php
  include "config.php";
  $stmt = $conn->prepare("SELECT cname, seatrem, duration, ctype, blurb FROM courses WHERE seatrem > 0");
  $stmt->execute();
  $result = $stmt->get_result();

  $courses = [];

  while ($row = $result->fetch_assoc()) {
    $courses[] = $row; 
  }

  header('Content-Type: application/json');
  echo json_encode($courses, JSON_PRETTY_PRINT);

  $stmt->close();
  $conn->close();

?>
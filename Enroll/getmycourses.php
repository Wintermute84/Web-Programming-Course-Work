<?php
  include "config.php";
  $stmt = $conn->prepare("SELECT e.eid, s.sid, s.sname, s.semail, c.cid, c.cname, c.duration, c.seatrem, c.blurb, c.ctype FROM enrolled e JOIN student s ON e.sid = s.sid JOIN courses c ON e.cid = c.cid where s.sid = ?;
");
  $stmt->bind_param("i",$_SESSION['sid']);
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
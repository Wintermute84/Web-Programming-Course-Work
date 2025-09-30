<?php
  include "config.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['user-name']);
    $email    = trim($_POST['email-input']);

    if (empty($username) || empty($email)) {
        die("Both fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $stmt = $conn->prepare("SELECT sid,sname FROM student WHERE semail = ? and sname = ?");
    $stmt->bind_param("ss", $email,$username);
    $stmt->execute();
    $stmt->bind_result($sid,$sname);

    if ($stmt->fetch()) {
        $_SESSION['sid']   = $sid;
        $_SESSION['sname'] = $sname;

        header("Location: courses.php");
        exit();
    } else {
        echo "<script>alert('No such email registered'); window.location.href='signup.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
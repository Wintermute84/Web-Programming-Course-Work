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

    $stmt = $conn->prepare("SELECT sid FROM student WHERE semail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Email already registered.");
    }
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO student (sname, semail) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $email);

    if ($stmt->execute()) {
        $sid = $stmt->insert_id;
        $_SESSION['sid'] = $sid;
        $_SESSION['sname'] = $username;
        header("Location: courses.php");
    } else {
        echo "alert(Error:  . $stmt->error)";
    }

    $stmt->close();
    $conn->close();
}
?>
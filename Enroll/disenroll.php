<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cid'])) {
    $sid = $_SESSION['sid'];
    $cid = intval($_POST['cid']);
    $stmt = $conn->prepare("DELETE FROM enrolled where sid=? AND cid=?");
    $stmt->bind_param("ii", $sid, $cid);

    if ($stmt->execute()) {
        $update = $conn->prepare("UPDATE courses SET seatrem = seatrem + 1 WHERE cid = ? AND seatrem > 0");
        $update->bind_param("i", $cid);
        $update->execute();
        $update->close();
        echo "<script>alert('Disenrollment successful!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cid'])) {
    $sid = $_SESSION['sid'];
    $cid = intval($_POST['cid']);

    $check = $conn->prepare("SELECT 1 FROM enrolled WHERE sid = ? AND cid = ?");
    $check->bind_param("ii", $sid, $cid);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Already enrolled in this course.');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO enrolled (sid, cid) VALUES (?, ?)");
        $stmt->bind_param("ii", $sid, $cid);

        if ($stmt->execute()) {
            $update = $conn->prepare("UPDATE courses SET seatrem = seatrem - 1 WHERE cid = ? AND seatrem > 0");
            $update->bind_param("i", $cid);
            $update->execute();
            $update->close();
            echo "<script>alert('Enrollment successful!');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    $check->close();
    $conn->close();
}
?>

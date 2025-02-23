<?php
include "db.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "❌ Please log in to book an event!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id'])) {
    $user_id = $_SESSION['user_id'];
    $event_id = $_POST['event_id'];

    $check_query = $conn->prepare("SELECT * FROM bookings WHERE user_id = ? AND event_id = ?");
    $check_query->bind_param("ii", $user_id, $event_id);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "⚠️ Already booked!";
    } else {
        $insert_query = $conn->prepare("INSERT INTO bookings (user_id, event_id) VALUES (?, ?)");
        $insert_query->bind_param("ii", $user_id, $event_id);

        if ($insert_query->execute()) {
            echo "✅ Booking Successful!";
        } else {
            echo "❌ Booking Failed!";
        }
    }
}
?>

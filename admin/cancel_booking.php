<?php
include "../db/db.php";
session_start();
$user_id = $_SESSION['user_id'];

$booked_events = $conn->query("SELECT b.id AS booking_id, e.id AS event_id, e.title, e.date, e.venue 
                               FROM bookings b JOIN events e ON b.event_id = e.id WHERE b.user_id = $user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('../background.jpg');
            text-align: center;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        button {
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.4);
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: rgba(255, 255, 255, 0.6);
        }
    </style>
</head>
<body>
    <h2>My Booked Events</h2>
    <table>
        <tr><th>Title</th><th>Date</th><th>Venue</th><th>Action</th></tr>
        <?php while ($row = $booked_events->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['title'] ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= $row['venue'] ?></td>
                <td>
                    <button onclick="confirmCancel(<?= $row['booking_id'] ?>, <?= $row['event_id'] ?>)">Cancel</button>
                </td>
            </tr>
        <?php } ?>
    </table>

    <script>
        function confirmCancel(bookingId, eventId) {
            if (confirm("Are you sure you want to cancel this booking?")) {
                window.location.href = "cancel_booking.php?booking_id=" + bookingId + "&event_id=" + eventId;
            }
        }
    </script>
</body>
</html>

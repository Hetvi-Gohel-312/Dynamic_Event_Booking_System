<?php
include "../db.php";
include "admin_check.php";

// Fetch event details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM events WHERE id=$id");
    $event = $result->fetch_assoc();
}

// Update event
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $venue = $_POST['venue'];
    $seats = $_POST['seats'];

    $conn->query("UPDATE events SET title='$title', date='$date', venue='$venue', available_seats='$seats' WHERE id=$id");
    header("Location: manage_events.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- ✅ Global CSS Included -->
</head>
<body>

<header>
    ✏ <b>Edit Event</b>
</header>

<nav>
    <a href="manage_events.php">⬅ Back to Manage Events</a>
</nav>

<form method="POST">
    <label>Title:</label>
    <input type="text" name="title" value="<?= $event['title'] ?>" required><br>

    <label>Date:</label>
    <input type="date" name="date" value="<?= $event['date'] ?>" required><br>

    <label>Venue:</label>
    <input type="text" name="venue" value="<?= $event['venue'] ?>" required><br>

    <label>Available Seats:</label>
    <input type="number" name="seats" value="<?= $event['available_seats'] ?>" required><br>

    <button type="submit">✅ Update Event</button>
</form>

<footer>
    &copy; <?= date("Y") ?> Event Booking System. All Rights Reserved.
</footer>

</body>
</html>

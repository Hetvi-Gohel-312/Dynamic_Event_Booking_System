<?php
include "../db.php";
include "admin_check.php"; // Ensure only admins can access

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $venue = $_POST['venue'];
    $available_seats = $_POST['available_seats'];

    $sql = "INSERT INTO events (title, description, date, venue, available_seats) 
            VALUES ('$title', '$description', '$date', '$venue', '$available_seats')";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_events.php"); // Redirect to event list
        exit();
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Event | Event Booking</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: white;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        input::placeholder, textarea::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        button {
            background: #0072ff;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s ease-in-out;
        }

        button:hover {
            background: #005ecb;
            transform: scale(1.05);
        }

        .menu {
            margin-top: 15px;
        }

        .menu a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            margin: 0 10px;
        }
    </style>

</head>
<body>

    <div class="container">
        <h2>➕ Add New Event</h2>

        <form method="POST">
            <input type="text" name="title" placeholder="Event Title" required>
            <textarea name="description" placeholder="Event Description" required></textarea>
            <input type="date" name="date" required>
            <input type="text" name="venue" placeholder="Venue" required>
            <input type="number" name="available_seats" placeholder="Available Seats" required>
            <button type="submit">✅ Add Event</button>
        </form>

        <div class="menu">
            <a href="dashboard.php">🏠 Dashboard</a> | 
            <a href="manage_events.php">📅 Manage Events</a>
        </div>
    </div>

</body>
</html>

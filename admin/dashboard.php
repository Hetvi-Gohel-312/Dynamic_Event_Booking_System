<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /event_booking/auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Event Booking</title>

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

        .dashboard-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
            width: 400px;
            text-align: center;
        }

        .dashboard-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .menu a {
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 5px;
            transition: 0.3s ease-in-out;
        }

        .menu a:hover {
            background: #0072ff;
            transform: scale(1.05);
        }

        .reset-btn {
            color: red;
            font-weight: bold;
            cursor: pointer;
        }

        .reset-btn:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body>

    <div class="dashboard-container">
        <h2>👨‍💼 Admin Dashboard</h2>

        <div class="menu">
            <a href="manage_events.php">📅 Manage Events</a>
            <a href="/event_booking/events.php">🎟 View Events</a>
            <a href="view_bookings.php">📋 View Bookings</a>
            <a href="/event_booking/auth/logout.php">🚪 Logout</a>
            <a href="/event_booking/reset.php" class="reset-btn" onclick="return confirm('Are you sure? This will delete all data!')">⚠️ Reset Database</a>
        </div>
    </div>

</body>
</html>

<?php
include "../db.php";
include "admin_check.php";

$result = $conn->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events | Event Booking</title>

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
            flex-direction: column;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
            width: 90%;
            max-width: 800px;
            text-align: center;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .menu {
            margin-bottom: 15px;
        }

        .menu a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .menu a:hover {
            background: #0072ff;
            transform: scale(1.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        th {
            background: rgba(255, 255, 255, 0.2);
            font-size: 18px;
        }

        tr:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .edit-btn, .delete-btn {
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            transition: 0.3s ease-in-out;
        }

        .edit-btn {
            background: #f39c12;
            color: white;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
        }

        .edit-btn:hover, .delete-btn:hover {
            transform: scale(1.05);
        }

        .add-btn {
            display: inline-block;
            margin-top: 15px;
            background: #27ae60;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            transition: 0.3s ease-in-out;
            text-decoration: none;
        }

        .add-btn:hover {
            background: #1e8449;
            transform: scale(1.05);
        }
    </style>

</head>
<body>

    <div class="container">
        <h2>📅 Manage Events</h2>

        <div class="menu">
            <a href="dashboard.php">🏠 Dashboard</a> | 
            <a href="logout.php">🚪 Logout</a>
        </div>

        <table>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Venue</th>
                <th>Seats</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['date']) ?></td>
                    <td><?= htmlspecialchars($row['venue']) ?></td>
                    <td><?= htmlspecialchars($row['available_seats']) ?></td>
                    <td>
                        <a href="edit_event.php?id=<?= $row['id'] ?>" class="edit-btn">✏ Edit</a>
                        <a href="delete_event.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure?')">🗑 Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <a href="add_event.php" class="add-btn">➕ Add Event</a>
    </div>

</body>
</html>

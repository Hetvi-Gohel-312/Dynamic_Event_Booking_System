<?php
include "db.php";
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

// Fetch unique venues from the database
$venues_query = "SELECT DISTINCT venue FROM events";
$venues_result = $conn->query($venues_query);

// Fetch filter values from GET request
$search = isset($_GET['search']) ? $_GET['search'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$venue = isset($_GET['venue']) ? $_GET['venue'] : '';

// Build the SQL query with filters
$sql = "SELECT * FROM events WHERE 1";

if (!empty($search)) {
    $sql .= " AND (title LIKE '%$search%' OR description LIKE '%$search%')";
}

if (!empty($date)) {
    $sql .= " AND date = '$date'";
}

if (!empty($venue)) {
    $sql .= " AND venue = '$venue'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Events</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background: linear-gradient(to right, #1e3c72, #2a5298); color: white; flex-direction: column; }
        .container { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); padding: 20px; border-radius: 10px; box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2); width: 90%; max-width: 800px; text-align: center; }
        h2 { font-size: 24px; margin-bottom: 20px; }
        .menu { margin-bottom: 15px; }
        .menu a { text-decoration: none; color: white; font-weight: bold; padding: 10px 15px; border-radius: 5px; transition: 0.3s; }
        .menu a:hover { background: #0072ff; transform: scale(1.1); }
        .filter-form { margin-bottom: 15px; }
        .filter-form input, .filter-form select { padding: 8px; margin: 5px; border-radius: 5px; border: none; font-size: 14px; }
        .filter-form button { padding: 8px 12px; border-radius: 5px; border: none; background: #0072ff; color: white; font-size: 14px; cursor: pointer; transition: 0.3s; }
        .filter-form button:hover { background: #0056b3; transform: scale(1.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; text-align: center; border-bottom: 1px solid rgba(255, 255, 255, 0.3); color: white; }
        th { background: rgba(255, 255, 255, 0.2); font-size: 18px; }
        tr:hover { background: rgba(255, 255, 255, 0.1); }
        .book-btn { background: #3498db; color: white; border: none; padding: 8px 12px; cursor: pointer; transition: 0.3s; border-radius: 5px; font-size: 14px; }
        .book-btn:hover { background: #2980b9; transform: scale(1.05); }
        .msg { display: block; font-weight: bold; margin-top: 5px; }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container">
    <h2>🎟 Available Events</h2>

    <div class="menu">
        <a href='/event_booking/admin/dashboard.php'>🏠 Dashboard</a> | 
        <a href='/event_booking/admin/view_bookings.php'>📋 View My Bookings</a> | 
        <a href='/event_booking/auth/logout.php'>🚪 Logout</a>
    </div>

    <!-- FILTER FORM -->
    <form method="GET" class="filter-form">
        <input type="text" name="search" placeholder="Search event..." value="<?= htmlspecialchars($search) ?>">
        <input type="date" name="date" value="<?= htmlspecialchars($date) ?>">
        <select name="venue">
            <option value="">All Venues</option>
            <?php while ($venue_row = $venues_result->fetch_assoc()) { ?>
                <option value="<?= htmlspecialchars($venue_row['venue']) ?>" <?= $venue == $venue_row['venue'] ? "selected" : "" ?>>
                    <?= htmlspecialchars($venue_row['venue']) ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Seats</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><?= htmlspecialchars($row['date']) ?></td>
            <td><?= htmlspecialchars($row['venue']) ?></td>
            <td><?= htmlspecialchars($row['available_seats']) ?></td>
            <td>
                <button class='book-btn' data-event-id='<?= $row['id'] ?>'>🛒 Book Now</button>
                <span class='msg' id='msg-<?= $row['id'] ?>'></span>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<script>
$(document).ready(function(){
    $(".book-btn").click(function(){
        var event_id = $(this).data("event-id");
        var msgBox = $("#msg-" + event_id);

        $.ajax({
            url: "book_event.php",
            type: "POST",
            data: { event_id: event_id },
            success: function(response) {
                msgBox.html(response).css("color", "lightgreen");
            },
            error: function() {
                msgBox.html("❌ Booking Failed!").css("color", "red");
            }
        });
    });
});
</script>

</body>
</html>

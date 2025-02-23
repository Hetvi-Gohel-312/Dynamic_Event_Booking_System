<?php
include "db.php";
session_start();

$result = $conn->query("SELECT * FROM events");

echo "<h2>Upcoming Events</h2>";
if (isset($_SESSION['user_id'])) {
    echo "<a href='auth\login.php'>🚪 Logout</a><br>";
} else {
    echo "<a href='auth\login.php'>🔑 Login</a> | <a href='auth/register.php'>📝 Register</a><br>";

}
echo "<table border='1'><tr><th>Title</th><th>Date</th><th>Venue</th><th>Seats</th><th>Action</th></tr>";
while ($row = $result->fetch_assoc()) {
    $button = $row['available_seats'] > 0 
        ? "<a href='book_event.php?id={$row['id']}'>✅ Book Now</a>" 
        : "❌ Sold Out";
    echo "<tr>
            <td>{$row['title']}</td>
            <td>{$row['date']}</td>
            <td>{$row['venue']}</td>
            <td>{$row['available_seats']}</td>
            <td>$button</td>
          </tr>";
}
echo "</table>";
?>

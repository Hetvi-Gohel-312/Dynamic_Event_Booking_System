<?php
include "db.php";
session_start();

// Reset Database (Delete all data)
$conn->query("DELETE FROM users");
$conn->query("DELETE FROM events");
$conn->query("DELETE FROM bookings");

// Destroy session
session_destroy();

// Show alert and redirect to register page
echo "<script>
        alert('✅ Database is empty now! Redirecting to registration page...');
        window.location.href = 'auth/register.php';
      </script>";
exit();
?>

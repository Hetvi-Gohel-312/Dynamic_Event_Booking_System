<?php
session_start();
session_destroy();
header("Location: /event_booking/auth/login.php"); // Redirect to login page
exit();
?>

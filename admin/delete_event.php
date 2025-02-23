<?php
include "../db.php";
include "admin_check.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM events WHERE id=$id");
}

header("Location: manage_events.php");
exit();
?>

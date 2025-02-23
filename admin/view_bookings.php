<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- ✅ Global CSS Included -->
    <style>
        * {
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

        /* ✅ Cancel Button */
        .cancel-btn {
            background: rgba(231, 76, 60, 0.8);
            color: white;
            border: none;
            padding: 7px 12px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s ease-in-out;
        }

        .cancel-btn:hover {
            background: rgba(192, 57, 43, 0.9);
            transform: scale(1.05);
        }

        /* ✅ Glassmorphic Popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
            text-align: center;
            width: 320px;
            color: white;
        }

        .popup button {
            margin: 10px;
            padding: 7px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .popup .confirm-btn {
            background: rgba(231, 76, 60, 0.8);
            color: white;
        }

        .popup .cancel-popup-btn {
            background: rgba(52, 73, 94, 0.8);
            color: white;
        }

        .confirm-btn:hover, .cancel-popup-btn:hover {
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
    <h2>📋 View Event Bookings</h2>

    <div class="menu">
        <a href="dashboard.php">🏠 Dashboard</a> | 
        <a href="../auth/logout.php">🚪 Logout</a>
    </div>

    <table>
        <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>Event Title</th>
            <th>Booking Date</th>
            <th>Actions</th>
        </tr>
        
        <?php
        include "../db.php";
        include "admin_check.php";

        $result = $conn->query("SELECT bookings.id, users.name, users.email, events.title, bookings.booking_date 
                                FROM bookings 
                                JOIN users ON bookings.user_id = users.id 
                                JOIN events ON bookings.event_id = events.id");

        while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['booking_date'] ?></td>
            <td>
                <button class="cancel-btn" onclick="showPopup(<?= $row['id'] ?>)">🗑 Cancel</button>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<!-- ✅ Glassmorphic Popup -->
<div id="cancelPopup" class="popup">
    <p>Are you sure you want to cancel this booking?</p>
    <button class="confirm-btn" id="confirmCancel">Yes, Cancel</button>
    <button class="cancel-popup-btn" onclick="closePopup()">No</button>
</div>

<script>
    let bookingId = null;

    function showPopup(id) {
        bookingId = id;
        document.getElementById("cancelPopup").style.display = "block";
    }

    function closePopup() {
        document.getElementById("cancelPopup").style.display = "none";
    }

    document.getElementById("confirmCancel").addEventListener("click", function() {
        fetch("cancel_booking.php?id=" + bookingId)
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => alert("Error canceling booking!"));

        closePopup();
    });
</script>

</body>
</html>

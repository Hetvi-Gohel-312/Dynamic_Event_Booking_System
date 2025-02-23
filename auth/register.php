<?php
include "../db.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Registration successful! Redirecting to login...'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('❌ Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Event Booking</title>

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

        .register-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
            width: 400px;
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 20px;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            outline: none;
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .register-btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background: #00c6ff;
            color: white;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .register-btn:hover {
            background: #0072ff;
            transform: scale(1.05);
        }

        .login-link {
            margin-top: 10px;
            font-size: 16px;
        }

        .login-link a {
            color: #00c6ff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

    </style>

</head>
<body>

    <div class="register-container">
        <h2>📝 Register</h2>

        <form method="POST">
            <div class="input-group">
                <label>Full Name:</label>
                <input type="text" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="input-group">
                <label>Email:</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            
            <div class="input-group">
                <label>Password:</label>
                <input type="password" name="password" placeholder="Create a password" required>
            </div>

            <button type="submit" class="register-btn">✅ Register</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>

    </div>

</body>
</html>

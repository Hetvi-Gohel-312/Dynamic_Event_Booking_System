<?php
include "../db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user details
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) { // Assuming passwords are hashed
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role']; // ✅ Store the role in session
        
            echo "<script>alert('✅ Login successful!'); window.location.href='../admin/dashboard.php';</script>";
            exit();
        } else {
            echo "<script>alert('❌ Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('❌ User not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Event Booking</title>

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

        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
            width: 350px;
            text-align: center;
        }

        .login-container h2 {
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

        .login-btn {
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

        .login-btn:hover {
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

        .forgot-password {
            margin-top: 10px;
            font-size: 16px;
        }

        .forgot-password a {
            color: #00c6ff;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body>

    <div class="login-container">
        <h2>🔐 Admin Login</h2>

        <form method="POST">
            <div class="input-group">
                <label>Email:</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            
            <div class="input-group">
                <label>Password:</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="login-btn">✅ Login</button>
        </form>

        <div class="login-link">
            Don't have an account? <a href="register.php">Register </a>
        </div>

        <div class="forgot-password">
            <a href="#">Forgot Password?</a>
        </div>
    </div>

</body>
</html>

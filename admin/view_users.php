<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Fetch all users (assuming role 'customer')
$users = $conn->query("SELECT * FROM users WHERE role = 'customer'");
?>

<main style="padding: 20px;">
    <h1>View Users</h1>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th style="padding: 10px; border: 1px solid #ccc;">ID</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Username</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Email</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Phone</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $users->fetch_assoc()) { ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $user['id']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $user['username']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $user['email']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $user['phone']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $user['created_at']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

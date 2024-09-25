<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Fetch all agents (assuming role 'agent')
$agents = $conn->query("SELECT * FROM users WHERE role = 'agent'");
?>

<main style="padding: 20px;">
    <h1>View Agents</h1>

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
            <?php while ($agent = $agents->fetch_assoc()) { ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $agent['id']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $agent['username']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $agent['email']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $agent['phone']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $agent['created_at']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

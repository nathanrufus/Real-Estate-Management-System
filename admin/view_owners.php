<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Fetch all owners (assuming role 'owner')
$owners = $conn->query("SELECT * FROM users WHERE role = 'owner'");
?>

<main style="padding: 20px;">
    <h1>View Owners</h1>

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
            <?php while ($owner = $owners->fetch_assoc()) { ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $owner['id']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $owner['username']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $owner['email']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $owner['phone']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $owner['created_at']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

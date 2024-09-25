<?php
include '../config/db_connect.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (password_verify($current_password, $result['password'])) {
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_password, $_SESSION['id']);

        if ($stmt->execute()) {
            $message = '<div class="message success" style="background-color: #d4edda; color: #155724; padding: 10px; text-align: center; border-radius: 5px;">Password changed successfully!</div>';
        } else {
            $message = '<div class="message error" style="background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center; border-radius: 5px;">Error: ' . $conn->error . '</div>';
        }
    } else {
        $message = '<div class="message error" style="background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center; border-radius: 5px;">Current password is incorrect!</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <main style="padding: 20px;">
        <h1 style="text-align: center; color: #333;">Change Password</h1>
        
        <?php echo $message; ?>

        <form method="POST" action="" style="max-width: 500px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <label for="current_password" style="font-weight: bold; margin-top: 10px;">Current Password:</label>
            <input type="password" name="current_password" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">

            <label for="new_password" style="font-weight: bold; margin-top: 10px;">New Password:</label>
            <input type="password" name="new_password" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">

            <button type="submit" style="width: 100%; background-color: #28a745; color: white; border: none; padding: 12px 0; font-size: 16px; border-radius: 5px; cursor: pointer; margin-top: 20px;">Change Password</button>
        </form>
    </main>
</body>
</html>

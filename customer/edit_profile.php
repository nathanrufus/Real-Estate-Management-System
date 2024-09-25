<?php
include '../config/db_connect.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $email, $_SESSION['id']);

    if ($stmt->execute()) {
        $_SESSION['username'] = $username; // Update session
        $_SESSION['email'] = $email; // Update email in session as well
        $message = '<div class="message success" style="background-color: #d4edda; color: #155724; padding: 10px; text-align: center; border-radius: 5px;">Profile updated successfully!</div>';
    } else {
        $message = '<div class="message error" style="background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center; border-radius: 5px;">Error: ' . $conn->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <main style="padding: 20px;">
        <h1 style="text-align: center; color: #333;">Edit Profile</h1>

        <?php echo $message; ?>

        <form method="POST" action="" style="max-width: 500px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <label for="username" style="font-weight: bold; margin-top: 10px;">Username:</label>
            <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">

            <label for="email" style="font-weight: bold; margin-top: 10px;">Email:</label>
            <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">

            <button type="submit" style="width: 100%; background-color: #007BFF; color: white; border: none; padding: 12px 0; font-size: 16px; border-radius: 5px; cursor: pointer; margin-top: 20px;">Update Profile</button>
        </form>
    </main>
</body>
</html>

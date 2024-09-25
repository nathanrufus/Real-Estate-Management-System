<?php
include '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, role, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $role, $email);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <label for="role">Role:</label>
    <select name="role" required>
        <option value="customer">Customer</option>
        <option value="owner">Owner</option>
    </select>
    <button type="submit">Register</button>
</form>

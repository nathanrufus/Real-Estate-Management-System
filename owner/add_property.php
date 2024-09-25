<?php
include '../config/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $city_id = $_POST['city_id'];
    $user_id = $_SESSION['id'];

    $sql = "INSERT INTO properties (user_id, title, description, price, status, city_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issdsi", $user_id, $title, $description, $price, $status, $city_id);

    if ($stmt->execute()) {
        echo "Property added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="">
    <label for="title">Property Title:</label>
    <input type="text" name="title" required>
    <label for="description">Description:</label>
    <textarea name="description" required></textarea>
    <label for="price">Price:</label>
    <input type="number" name="price" required>
    <label for="status">Status:</label>
    <select name="status" required>
        <option value="available">Available</option>
        <option value="sold">Sold</option>
        <option value="rented">Rented</option>
    </select>
    <label for="city_id">City:</label>
    <select name="city_id" required>
        <?php
        $cities = $conn->query("SELECT * FROM cities");
        while ($city = $cities->fetch_assoc()) {
            echo "<option value='{$city['id']}'>{$city['name']}</option>";
        }
        ?>
    </select>
    <button type="submit">Add Property</button>
</form>

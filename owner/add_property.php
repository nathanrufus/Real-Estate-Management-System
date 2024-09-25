<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an owner
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'owner') {
    header("Location: /auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type_id = $_POST['type_id'];
    $city_id = $_POST['city_id'];
    $status = $_POST['status'];

    // Insert new property into the database
    $sql = "INSERT INTO properties (user_id, title, description, price, type_id, city_id, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issdiis", $_SESSION['id'], $title, $description, $price, $type_id, $city_id, $status);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Property added successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<main style="padding: 20px;">
    <h1>Add New Property</h1>
    <form method="POST" action="" style="max-width: 600px; margin: 0 auto;">
        <label for="title" style="font-weight: bold;">Title:</label>
        <input type="text" name="title" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="description" style="font-weight: bold;">Description:</label>
        <textarea name="description" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc;"></textarea>

        <label for="price" style="font-weight: bold;">Price (USD):</label>
        <input type="number" name="price" step="0.01" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="type_id" style="font-weight: bold;">Property Type:</label>
        <select name="type_id" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc;">
            <?php
            $types = $conn->query("SELECT * FROM property_types");
            while ($type = $types->fetch_assoc()) {
                echo "<option value='{$type['id']}'>{$type['name']}</option>";
            }
            ?>
        </select>

        <label for="city_id" style="font-weight: bold;">City:</label>
        <select name="city_id" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc;">
            <?php
            $cities = $conn->query("SELECT * FROM cities");
            while ($city = $cities->fetch_assoc()) {
                echo "<option value='{$city['id']}'>{$city['name']}</option>";
            }
            ?>
        </select>

        <label for="status" style="font-weight: bold;">Status:</label>
        <select name="status" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc;">
            <option value="available">Available</option>
            <option value="sold">Sold</option>
            <option value="rented">Rented</option>
        </select>

        <button type="submit" style="background-color: #28a745; color: white; padding: 15px; width: 100%; border-radius: 5px; border: none; cursor: pointer;">Add Property</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>

<?php
include '../config/db_connect.php';
include '../includes/header.php';
include '../includes/navbar.php';

$property_type = isset($_GET['type']) ? $_GET['type'] : '';
$city = isset($_GET['city']) ? $_GET['city'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "SELECT * FROM properties WHERE 1";
if ($property_type) {
    $sql .= " AND type_id = '$property_type'";
}
if ($city) {
    $sql .= " AND city_id = '$city'";
}
if ($status) {
    $sql .= " AND status = '$status'";
}

$result = $conn->query($sql);
?>

<main style="padding: 20px;">
    <h1>Browse Properties</h1>
    <form method="GET" action="">
        <label for="type">Property Type:</label>
        <select name="type">
            <option value="">All</option>
            <?php
            $types = $conn->query("SELECT * FROM property_types");
            while ($type = $types->fetch_assoc()) {
                echo "<option value='{$type['id']}'>{$type['name']}</option>";
            }
            ?>
        </select>

        <label for="city">City:</label>
        <select name="city">
            <option value="">All</option>
            <?php
            $cities = $conn->query("SELECT * FROM cities");
            while ($city = $cities->fetch_assoc()) {
                echo "<option value='{$city['id']}'>{$city['name']}</option>";
            }
            ?>
        </select>

        <label for="status">Status:</label>
        <select name="status">
            <option value="">All</option>
            <option value="available">Available</option>
            <option value="sold">Sold</option>
            <option value="rented">Rented</option>
        </select>

        <button type="submit">Filter</button>
    </form>

    <div class="properties-list" style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php while ($property = $result->fetch_assoc()) { ?>
            <div class="property-item" style="border: 1px solid #ccc; padding: 15px; border-radius: 10px; width: 30%;">
                <h3><?php echo $property['title']; ?></h3>
                <p><?php echo $property['description']; ?></p>
                <a href="property_details.php?id=<?php echo $property['id']; ?>">View Details</a>
            </div>
        <?php } ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>

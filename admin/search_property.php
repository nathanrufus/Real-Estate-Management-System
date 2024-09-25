<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Handle search query
$searchResults = [];
if ($_SERVER['REQUEST_METHOD'] == 'GET' && (isset($_GET['property_id']) || isset($_GET['property_name']) || isset($_GET['mobile_number']))) {
    $propertyId = $_GET['property_id'];
    $propertyName = $_GET['property_name'];
    $mobileNumber = $_GET['mobile_number'];

    $sql = "SELECT properties.*, users.phone FROM properties JOIN users ON properties.user_id = users.id WHERE 1=1";
    
    if (!empty($propertyId)) {
        $sql .= " AND properties.id = '$propertyId'";
    }
    if (!empty($propertyName)) {
        $sql .= " AND properties.title LIKE '%$propertyName%'";
    }
    if (!empty($mobileNumber)) {
        $sql .= " AND users.phone = '$mobileNumber'";
    }

    $searchResults = $conn->query($sql);
}
?>

<main style="padding: 20px;">
    <h1>Search Properties</h1>
    <form method="GET" style="margin-bottom: 20px;">
        <input type="text" name="property_id" placeholder="Property ID" style="padding: 10px; margin-right: 10px;">
        <input type="text" name="property_name" placeholder="Property Name" style="padding: 10px; margin-right: 10px;">
        <input type="text" name="mobile_number" placeholder="Mobile Number" style="padding: 10px; margin-right: 10px;">
        <button type="submit" style="padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Search</button>
    </form>

    <?php if (!empty($searchResults)) { ?>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f4f4f4;">
                    <th style="padding: 10px; border: 1px solid #ccc;">Property ID</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Property Name</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Price</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Status</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Owner's Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($property = $searchResults->fetch_assoc()) { ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $property['id']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $property['title']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ccc;">$<?php echo number_format($property['price'], 2); ?></td>
                        <td style="padding: 10px; border: 1px solid #ccc;"><?php echo ucfirst($property['status']); ?></td>
                        <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $property['phone']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</main>

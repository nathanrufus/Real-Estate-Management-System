<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Add or update property type
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if ($id) {
        // Update property type
        $sql = "UPDATE property_types SET name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $name, $id);
        $stmt->execute();
    } else {
        // Add new property type
        $sql = "INSERT INTO property_types (name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();
    }
}

// Fetch all property types
$types = $conn->query("SELECT * FROM property_types");
?>

<main style="padding: 20px;">
    <h1>Manage Property Types</h1>
    <form method="POST" style="margin-bottom: 20px;">
        <input type="text" name="name" placeholder="Property Type Name" required style="padding: 10px; margin-right: 10px;">
        <button type="submit" style="padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px;">Add Property Type</button>
    </form>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th style="padding: 10px; border: 1px solid #ccc;">ID</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Name</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($type = $types->fetch_assoc()) { ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $type['id']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $type['name']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $type['id']; ?>">
                            <input type="text" name="name" value="<?php echo $type['name']; ?>" required style="padding: 5px; margin-right: 10px;">
                            <button type="submit" style="padding: 5px 10px; background-color: #ffc107; color: white; border: none; border-radius: 5px;">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

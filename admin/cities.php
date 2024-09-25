<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Add or update city
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $state_id = $_POST['state_id'];
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if ($id) {
        // Update city
        $sql = "UPDATE cities SET name = ?, state_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii', $name, $state_id, $id);
        $stmt->execute();
    } else {
        // Add new city
        $sql = "INSERT INTO cities (name, state_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $name, $state_id);
        $stmt->execute();
    }
}

// Fetch all cities and states
$cities = $conn->query("SELECT cities.*, states.name AS state FROM cities JOIN states ON cities.state_id = states.id");
$states = $conn->query("SELECT * FROM states");
?>

<main style="padding: 20px;">
    <h1>Manage Cities</h1>
    <form method="POST" style="margin-bottom: 20px;">
        <input type="text" name="name" placeholder="City Name" required style="padding: 10px; margin-right: 10px;">
        <select name="state_id" required style="padding: 10px; margin-right: 10px;">
            <option value="">Select State</option>
            <?php while ($state = $states->fetch_assoc()) { ?>
                <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
            <?php } ?>
        </select>
        <button type="submit" style="padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px;">Add City</button>
    </form>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th style="padding: 10px; border: 1px solid #ccc;">ID</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Name</th>
                <th style="padding: 10px; border: 1px solid #ccc;">State</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($city = $cities->fetch_assoc()) { ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $city['id']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $city['name']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $city['state']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $city['id']; ?>">
                            <input type="text" name="name" value="<?php echo $city['name']; ?>" required style="padding: 5px; margin-right: 10px;">
                            <button type="submit" style="padding: 5px 10px; background-color: #ffc107; color: white; border: none; border-radius: 5px;">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

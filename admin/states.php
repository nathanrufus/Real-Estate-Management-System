<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Add or update state
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $country_id = $_POST['country_id'];
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if ($id) {
        // Update state
        $sql = "UPDATE states SET name = ?, country_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii', $name, $country_id, $id);
        $stmt->execute();
    } else {
        // Add new state
        $sql = "INSERT INTO states (name, country_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $name, $country_id);
        $stmt->execute();
    }
}

// Fetch all states and countries
$states = $conn->query("SELECT states.*, countries.name AS country FROM states JOIN countries ON states.country_id = countries.id");
$countries = $conn->query("SELECT * FROM countries");
?>

<main style="padding: 20px;">
    <h1>Manage States</h1>
    <form method="POST" style="margin-bottom: 20px;">
        <input type="text" name="name" placeholder="State Name" required style="padding: 10px; margin-right: 10px;">
        <select name="country_id" required style="padding: 10px; margin-right: 10px;">
            <option value="">Select Country</option>
            <?php while ($country = $countries->fetch_assoc()) { ?>
                <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
            <?php } ?>
        </select>
        <button type="submit" style="padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px;">Add State</button>
    </form>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th style="padding: 10px; border: 1px solid #ccc;">ID</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Name</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Country</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($state = $states->fetch_assoc()) { ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $state['id']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $state['name']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $state['country']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $state['id']; ?>">
                            <input type="text" name="name" value="<?php echo $state['name']; ?>" required style="padding: 5px; margin-right: 10px;">
                            <button type="submit" style="padding: 5px 10px; background-color: #ffc107; color: white; border: none; border-radius: 5px;">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

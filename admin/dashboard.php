<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Fetching data counts for the dashboard
$total_property_types = $conn->query("SELECT COUNT(*) as count FROM property_types")->fetch_assoc()['count'];
$total_countries = $conn->query("SELECT COUNT(*) as count FROM countries")->fetch_assoc()['count'];
$total_states = $conn->query("SELECT COUNT(*) as count FROM states")->fetch_assoc()['count'];
$total_cities = $conn->query("SELECT COUNT(*) as count FROM cities")->fetch_assoc()['count'];
$total_owners = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'owner'")->fetch_assoc()['count'];
$total_agents = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'agent'")->fetch_assoc()['count'];
$total_users = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'customer'")->fetch_assoc()['count'];
$total_properties = $conn->query("SELECT COUNT(*) as count FROM properties")->fetch_assoc()['count'];

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<main style="padding: 20px;">
    <h1>Admin Dashboard</h1>
    <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
        <div style="border: 1px solid #ccc; padding: 15px; width: 30%; border-radius: 10px; background-color: #f9f9f9;">
            <h3>Total Property Types</h3>
            <p><?php echo $total_property_types; ?></p>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; width: 30%; border-radius: 10px; background-color: #f9f9f9;">
            <h3>Total Countries</h3>
            <p><?php echo $total_countries; ?></p>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; width: 30%; border-radius: 10px; background-color: #f9f9f9;">
            <h3>Total States</h3>
            <p><?php echo $total_states; ?></p>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; width: 30%; border-radius: 10px; background-color: #f9f9f9;">
            <h3>Total Cities</h3>
            <p><?php echo $total_cities; ?></p>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; width: 30%; border-radius: 10px; background-color: #f9f9f9;">
            <h3>Total Owners</h3>
            <p><?php echo $total_owners; ?></p>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; width: 30%; border-radius: 10px; background-color: #f9f9f9;">
            <h3>Total Agents</h3>
            <p><?php echo $total_agents; ?></p>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; width: 30%; border-radius: 10px; background-color: #f9f9f9;">
            <h3>Total Buyers (Users)</h3>
            <p><?php echo $total_users; ?></p>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; width: 30%; border-radius: 10px; background-color: #f9f9f9;">
            <h3>Total Properties Listed</h3>
            <p><?php echo $total_properties; ?></p>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>

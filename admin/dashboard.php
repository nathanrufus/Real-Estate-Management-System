<?php include '../config/db_connect.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<main>
    <h1>Admin Dashboard</h1>
    <?php
    $total_properties = $conn->query("SELECT COUNT(id) AS total FROM properties")->fetch_assoc()['total'];
    $total_users = $conn->query("SELECT COUNT(id) AS total FROM users")->fetch_assoc()['total'];
    ?>
    <p>Total Properties: <?php echo $total_properties; ?></p>
    <p>Total Users: <?php echo $total_users; ?></p>
</main>

<?php include '../includes/footer.php'; ?>

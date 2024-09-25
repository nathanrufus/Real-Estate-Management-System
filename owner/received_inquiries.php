<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an owner
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'owner') {
    header("Location: /auth/login.php");
    exit();
}

// Fetch inquiries related to the logged-in owner's properties
$sql = "
    SELECT inquiries.id as inquiry_id, inquiries.message, inquiries.created_at, inquiries.status, 
           properties.title as property_title, users.username as customer_name
    FROM inquiries
    INNER JOIN properties ON inquiries.property_id = properties.id
    INNER JOIN users ON inquiries.customer_id = users.id
    WHERE properties.user_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['id']); // Owner's ID from the session
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<main style="padding: 20px;">
    <h1>Received Inquiries</h1>
    <div class="inquiries-list" style="display: flex; flex-direction: column; gap: 20px;">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($inquiry = $result->fetch_assoc()): ?>
                <div class="inquiry-item" style="border: 1px solid #ccc; padding: 15px; border-radius: 10px;">
                    <h3>Property: <?php echo $inquiry['property_title']; ?></h3>
                    <p><strong>Customer:</strong> <?php echo $inquiry['customer_name']; ?></p>
                    <p><strong>Message:</strong> <?php echo $inquiry['message']; ?></p>
                    <p><strong>Date:</strong> <?php echo $inquiry['created_at']; ?></p>
                    <p><strong>Status:</strong> <?php echo ucfirst($inquiry['status']); ?></p>
                    <?php if ($inquiry['status'] == 'unanswered'): ?>
                        <a href="answer_inquiry.php?id=<?php echo $inquiry['inquiry_id']; ?>" style="background-color: #007BFF; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Answer Inquiry</a>
                    <?php else: ?>
                        <p><em>This inquiry has been answered.</em></p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No inquiries received yet.</p>
        <?php endif; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>

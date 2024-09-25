<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an owner
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'owner') {
    header("Location: /auth/login.php");
    exit();
}

$inquiry_id = $_GET['id'];

// Fetch the inquiry details
$sql = "
    SELECT inquiries.id as inquiry_id, inquiries.message, properties.title as property_title, users.username as customer_name
    FROM inquiries
    INNER JOIN properties ON inquiries.property_id = properties.id
    INNER JOIN users ON inquiries.customer_id = users.id
    WHERE inquiries.id = ? AND properties.user_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $inquiry_id, $_SESSION['id']); // Owner's ID and Inquiry ID
$stmt->execute();
$result = $stmt->get_result();
$inquiry = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = $_POST['response'];
    
    // Update inquiry status to "answered" and save the response
    $sql = "UPDATE inquiries SET status = 'answered' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $inquiry_id);
    
    if ($stmt->execute()) {
        // You can save the owner's response to another table if needed.
        echo "Inquiry answered successfully!";
        header("Location: received_inquiries.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<main style="padding: 20px;">
    <h1>Answer Inquiry</h1>
    <div class="inquiry-details" style="border: 1px solid #ccc; padding: 15px; border-radius: 10px;">
        <h3>Property: <?php echo $inquiry['property_title']; ?></h3>
        <p><strong>Customer:</strong> <?php echo $inquiry['customer_name']; ?></p>
        <p><strong>Message:</strong> <?php echo $inquiry['message']; ?></p>
        <form method="POST" action="" style="margin-top: 20px;">
            <label for="response">Your Response:</label>
            <textarea name="response" required style="width: 100%; padding: 10px; margin-top: 10px; border-radius: 5px; border: 1px solid #ccc;"></textarea>
            <button type="submit" style="background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; margin-top: 15px;">Submit Response</button>
        </form>
    </div>
</main>

<?php include '../includes/footer.php'; ?>

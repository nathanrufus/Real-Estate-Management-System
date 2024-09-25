<?php
include '../config/db_connect.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];
    $customer_id = $_SESSION['id'];
    $inquiry_message = $_POST['message'];

    $sql = "INSERT INTO inquiries (property_id, customer_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $property_id, $customer_id, $inquiry_message);

    if ($stmt->execute()) {
        $message = '<div class="message success" style="background-color: #d4edda; color: #155724; padding: 10px; text-align: center; border-radius: 5px;">Inquiry sent successfully!</div>';
    } else {
        $message = '<div class="message error" style="background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center; border-radius: 5px;">Error: ' . $conn->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Submission</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <main style="padding: 20px;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <h1 style="text-align: center; color: #333;">Inquiry Submission</h1>
            
            <?php echo $message; ?>
            
            <a href="browse_properties.php" style="display: block; text-align: center; background-color: #007BFF; color: white; padding: 12px; text-decoration: none; border-radius: 5px; margin-top: 20px; font-size: 16px;">Go Back to Properties</a>
        </div>
    </main>
</body>
</html>

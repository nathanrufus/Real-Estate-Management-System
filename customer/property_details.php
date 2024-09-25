<?php
include '../config/db_connect.php';
include '../includes/header.php';
include '../includes/navbar.php';

$property_id = $_GET['id'];
$property = $conn->query("SELECT * FROM properties WHERE id = '$property_id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $property['title']; ?></title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <main style="padding: 20px;">
        <div style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 800px; margin: 0 auto;">
            <h1 style="color: #333;"><?php echo $property['title']; ?></h1>
            <p style="color: #666; font-size: 16px;"><?php echo $property['description']; ?></p>
            <p style="font-size: 18px; font-weight: bold;">Price: $<?php echo number_format($property['price'], 2); ?></p>
            <p style="font-size: 16px; color: <?php echo ($property['status'] == 'available') ? '#28a745' : '#dc3545'; ?>; font-weight: bold;">
                Status: <?php echo ucfirst($property['status']); ?>
            </p>

            <h3 style="color: #333; margin-top: 30px;">Send an Inquiry</h3>
            <form method="POST" action="send_inquiry.php" style="margin-top: 20px;">
                <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
                
                <textarea name="message" placeholder="Your inquiry..." style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 20px; font-size: 16px;" required></textarea>
                
                <button type="submit" style="width: 100%; background-color: #007BFF; color: white; border: none; padding: 12px; font-size: 16px; border-radius: 5px; cursor: pointer;">Send Inquiry</button>
            </form>
        </div>
    </main>
</body>
</html>

<?php include '../includes/footer.php'; ?>

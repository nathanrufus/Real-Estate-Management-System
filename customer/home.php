<?php
include '../config/db_connect.php';
session_start();
include '../includes/header.php';
include '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <main style="padding: 20px;">
        <h1 style="text-align: center; color: #333;">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        
        <p style="text-align: center; font-size: 18px; color: #666; max-width: 600px; margin: 0 auto;">
            We're delighted to have you on CORE COMMERCIAL Real Estate. You can browse through our latest property listings, contact our team for inquiries, or manage your account settings. Use the quick links below to navigate easily.
        </p>

        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 40px; flex-wrap: wrap;">
            <a href="browse_properties.php" style="background-color: #007BFF; color: white; padding: 15px 25px; text-decoration: none; border-radius: 5px; font-size: 18px; text-align: center;">Browse Properties</a>
            <a href="../pages/contact_us.php" style="background-color: #28a745; color: white; padding: 15px 25px; text-decoration: none; border-radius: 5px; font-size: 18px; text-align: center;">Contact Us</a>
            <a href="edit_profile.php" style="background-color: #ffc107; color: white; padding: 15px 25px; text-decoration: none; border-radius: 5px; font-size: 18px; text-align: center;">Edit Profile</a>
        </div>

        <section style="margin-top: 60px; text-align: center;">
            <h2 style="color: #333;">Latest Property Listings</h2>
            <p style="color: #666;">Explore our latest properties added to the platform.</p>

            <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-top: 30px;">
                <?php
                $latest_properties = $conn->query("SELECT * FROM properties ORDER BY created_at DESC LIMIT 3");
                while ($property = $latest_properties->fetch_assoc()) {
                    echo '
                    <div style="background-color: #fff; border-radius: 10px; padding: 20px; width: 300px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        <h3 style="color: #333;">' . $property['title'] . '</h3>
                        <p style="color: #666;">' . substr($property['description'], 0, 100) . '...</p>
                        <a href="property_details.php?id=' . $property['id'] . '" style="background-color: #007BFF; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 10px;">View Details</a>
                    </div>';
                }
                ?>
            </div>
        </section>

        <section style="margin-top: 60px; text-align: center;">
            <h2 style="color: #333;">Why Choose Us?</h2>
            <p style="color: #666; max-width: 600px; margin: 0 auto;">
                At CORE COMMERCIAL Real Estate, we pride ourselves on offering the best services for buying, selling, and renting properties. We are committed to providing exceptional customer service and ensuring a seamless experience throughout your property journey.
            </p>

            <div style="display: flex; justify-content: center; gap: 20px; margin-top: 30px; flex-wrap: wrap;">
                <div style="background-color: #fff; border-radius: 10px; padding: 20px; width: 300px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <h3 style="color: #28a745;">Wide Property Listings</h3>
                    <p style="color: #666;">We offer a diverse range of properties that cater to all needs and budgets.</p>
                </div>
                <div style="background-color: #fff; border-radius: 10px; padding: 20px; width: 300px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <h3 style="color: #007BFF;">Expert Support</h3>
                    <p style="color: #666;">Our team of real estate experts is here to assist you with any inquiries you may have.</p>
                </div>
                <div style="background-color: #fff; border-radius: 10px; padding: 20px; width: 300px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <h3 style="color: #ffc107;">Seamless Process</h3>
                    <p style="color: #666;">We ensure that your experience of buying, selling, or renting is as smooth as possible.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

<?php include '../includes/footer.php'; ?>

<?php include '../config/db_connect.php'; ?>
<?php include
 session_start();
 '../includes/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - CORE COMMERCIAL Real Estate</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <main style="padding: 40px;">
        <div style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 800px; margin: 0 auto;">
            <h1 style="text-align: center; color: #333;">Contact Us</h1>
            <p style="color: #666; font-size: 16px; text-align: justify;">
                We are here to help you with all your real estate needs. If you have any questions, inquiries, or would like to schedule a property viewing, feel free to reach out to us. Our team is always ready to assist you in finding the perfect property or guiding you through the selling or renting process.
            </p>

            <h2 style="color: #333; margin-top: 30px;">Our Contact Information</h2>
            <p style="color: #666; font-size: 16px;">
                <strong>Email:</strong> contact@corecommercial.com<br>
                <strong>Phone:</strong> +123 456 7890<br>
                <strong>Office Hours:</strong> Monday to Friday, 9 AM to 5 PM
            </p>

            <h2 style="color: #333; margin-top: 30px;">Our Office Location</h2>
            <p style="color: #666; font-size: 16px;">
                CORE COMMERCIAL Real Estate<br>
                123 Main Street, Northern Suburbs<br>
                City, State, Zip Code
            </p>

            <h2 style="color: #333; margin-top: 30px;">Get in Touch</h2>
            <form method="POST" action="send_message.php" style="margin-top: 20px;">
                <label for="name" style="font-weight: bold; color: #333;">Your Name:</label>
                <input type="text" name="name" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">

                <label for="email" style="font-weight: bold; color: #333;">Your Email:</label>
                <input type="email" name="email" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">

                <label for="message" style="font-weight: bold; color: #333;">Your Message:</label>
                <textarea name="message" required style="width: 100%; height: 150px; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;"></textarea>

                <button type="submit" style="width: 100%; background-color: #007BFF; color: white; border: none; padding: 12px; font-size: 16px; border-radius: 5px; cursor: pointer;">Send Message</button>
            </form>
        </div>
    </main>
</body>
</html>

<?php include '../includes/footer.php'; ?>

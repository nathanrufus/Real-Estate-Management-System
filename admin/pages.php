<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Fetch page content
$aboutUs = $conn->query("SELECT content FROM pages WHERE page_type = 'about'")->fetch_assoc();
$contactUs = $conn->query("SELECT content FROM pages WHERE page_type = 'contact'")->fetch_assoc();

// Update page content
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aboutContent = $_POST['about_content'];
    $contactContent = $_POST['contact_content'];

    // Update About Us page
    $stmt = $conn->prepare("UPDATE pages SET content = ? WHERE page_type = 'about'");
    $stmt->bind_param('s', $aboutContent);
    $stmt->execute();

    // Update Contact Us page
    $stmt = $conn->prepare("UPDATE pages SET content = ? WHERE page_type = 'contact'");
    $stmt->bind_param('s', $contactContent);
    $stmt->execute();

    echo "<p style='color: green;'>Pages updated successfully!</p>";
}
?>

<main style="padding: 20px;">
    <h1>Manage Pages</h1>
    <form method="POST" style="margin-bottom: 20px;">
        <!-- About Us -->
        <label for="about_content" style="font-weight: bold;">About Us:</label><br>
        <textarea name="about_content" rows="5" style="width: 100%; padding: 10px; margin-bottom: 20px;"><?php echo $aboutUs['content']; ?></textarea><br>

        <!-- Contact Us -->
        <label for="contact_content" style="font-weight: bold;">Contact Us:</label><br>
        <textarea name="contact_content" rows="5" style="width: 100%; padding: 10px;"><?php echo $contactUs['content']; ?></textarea><br>

        <!-- Submit Button -->
        <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px;">Update Pages</button>
    </form>
</main>

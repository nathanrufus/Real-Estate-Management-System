<?php
include '../config/db_connect.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Fetch all reviews
$reviews = $conn->query("SELECT reviews.*, properties.title, users.username FROM reviews
                         JOIN properties ON reviews.property_id = properties.id
                         JOIN users ON reviews.user_id = users.id");

// Handle review actions (approve/disapprove/delete)
if (isset($_POST['action'])) {
    $review_id = $_POST['review_id'];
    if ($_POST['action'] == 'approve') {
        $conn->query("UPDATE reviews SET status = 'approved' WHERE id = $review_id");
    } elseif ($_POST['action'] == 'disapprove') {
        $conn->query("UPDATE reviews SET status = 'disapproved' WHERE id = $review_id");
    } elseif ($_POST['action'] == 'delete') {
        $conn->query("DELETE FROM reviews WHERE id = $review_id");
    }
}

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<main style="padding: 20px;">
    <h1>Manage Reviews</h1>

    <!-- List of Reviews -->
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th style="padding: 10px; border: 1px solid #ccc;">Property</th>
                <th style="padding: 10px; border: 1px solid #ccc;">User</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Review</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Rating</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Status</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($review = $reviews->fetch_assoc()) { ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $review['title']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $review['username']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $review['review']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $review['rating']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo ucfirst($review['status']); ?></td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                            <button type="submit" name="action" value="approve" style="padding: 5px 10px; background-color: #28a745; color: white; border: none; border-radius: 5px;">Approve</button>
                            <button type="submit" name="action" value="disapprove" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 5px;">Disapprove</button>
                            <button type="submit" name="action" value="delete" style="padding: 5px 10px; background-color: #6c757d; color: white; border: none; border-radius: 5px;">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<?php include '../includes/footer.php'; ?>

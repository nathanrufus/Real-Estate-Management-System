<nav>
    <ul>
        <li><a href="/index.php">Home</a></li>
        <li><a href="/pages/about_us.php">About Us</a></li>
        <li><a href="/pages/contact_us.php">Contact Us</a></li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
            <li><a href="/admin/dashboard.php">Admin Dashboard</a></li>
        <?php } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'owner') { ?>
            <li><a href="/owner/my_properties.php">My Properties</a></li>
        <?php } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'customer') { ?>
            <li><a href="/customer/browse_properties.php">Browse Properties</a></li>
        <?php } ?>
        <li><a href="/auth/logout.php">Logout</a></li>
    </ul>
</nav>

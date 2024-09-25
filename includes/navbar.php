<nav style="background-color: #333; padding: 10px;">
    <ul style="list-style: none; margin: 0; padding: 0; display: flex; justify-content: center; position: relative;">
        <!-- Home -->
        <li style="margin: 0 15px;">
            <a href="/Real-Estate-Management-System/index.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Home</a>
        </li>
        <!-- About Us -->
        <li style="margin: 0 15px;">
            <a href="/Real-Estate-Management-System/pages/about_us.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">About Us</a>
        </li>
        <!-- Contact Us -->
        <li style="margin: 0 15px;">
            <a href="/Real-Estate-Management-System/pages/contact_us.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Contact Us</a>
        </li>

        <!-- Logged in users (Admin, Owner, Customer) -->
        <?php if (isset($_SESSION['role'])) { 
            // Admin Links
            if ($_SESSION['role'] == 'admin') { ?>
                <li style="margin: 0 15px;">
                    <a href="/admin/dashboard.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Admin Dashboard</a>
                </li>

            <!-- Owner Links -->
            <?php } elseif ($_SESSION['role'] == 'owner') { ?>
                <li style="margin: 0 15px;">
                    <a href="/Real-Estate-Management-System/customer/browse_properties.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Properties</a>
                </li>
                <li style="margin: 0 15px; position: relative;">
                    <a href="#" id="account-link" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">My Account</a>
                    <ul id="account-dropdown" style="list-style: none; margin: 0; padding: 10px 0; position: absolute; background-color: #444; top: 100%; left: 0; width: 200px; display: none; border-radius: 5px;">
                        <!-- Owner-specific account options -->
                        <li><a href="/Real-Estate-Management-System/customer/change_password.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Edit Profile</a></li>
                        <li><a href="/Real-Estate-Management-System/customer/change_password.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Change Password</a></li>
                        <li><a href="/Real-Estate-Management-System/owner/add_property.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Add Property</a></li>
                        <li><a href="/Real-Estate-Management-System/owner/my_properties.php" style="text-decoration: none; color: white; padding: 10px; display: block;">My Properties</a></li>
                        <li><a href="/Real-Estate-Management-System/owner/received_inquiries.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Received Enquiries</a></li>
                        <li><a href="/Real-Estate-Management-System/owner/answer_inquiry.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Answer Enquiries</a></li>
                        <li><a href="/Real-Estate-Management-System/auth/logout.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Logout</a></li>
                    </ul>
                </li>

                <!-- Dropdown toggle JavaScript for owner -->
                <script>
                    const accountLink = document.getElementById('account-link');
                    const dropdown = document.getElementById('account-dropdown');
                    accountLink.addEventListener('mouseover', function() {
                        dropdown.style.display = 'block';
                    });
                    dropdown.addEventListener('mouseleave', function() {
                        dropdown.style.display = 'none';
                    });
                </script>

            <!-- Customer Links -->
            <?php } elseif ($_SESSION['role'] == 'customer') { ?>
                <li style="margin: 0 15px;">
                    <a href="/Real-Estate-Management-System/customer/browse_properties.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Properties</a>
                </li>
                <li style="margin: 0 15px; position: relative;">
                    <a href="#" id="customer-account-link" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Account</a>
                    <ul id="customer-account-dropdown" style="list-style: none; margin: 0; padding: 10px 0; position: absolute; background-color: #444; top: 100%; left: 0; width: 150px; display: none; border-radius: 5px;">
                        <li><a href="/Real-Estate-Management-System/customer/edit_profile.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Edit Profile</a></li>
                        <li><a href="/Real-Estate-Management-System/customer/change_password.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Change Password</a></li>
                        <li><a href="/Real-Estate-Management-System/auth/logout.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Logout</a></li>
                    </ul>
                </li>

                <!-- Customer dropdown JavaScript -->
                <script>
                    const customerAccountLink = document.getElementById('customer-account-link');
                    const customerDropdown = document.getElementById('customer-account-dropdown');
                    customerAccountLink.addEventListener('mouseover', function() {
                        customerDropdown.style.display = 'block';
                    });
                    customerDropdown.addEventListener('mouseleave', function() {
                        customerDropdown.style.display = 'none';
                    });
                </script>

            <?php } ?>
        <?php } else { ?>
            <!-- Login and Sign Up Links for Non-Logged-in Users -->
            <li style="margin: 0 15px;">
                <a href="/Real-Estate-Management-System/auth/login.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Login</a>
            </li>
            <li style="margin: 0 15px;">
                <a href="/Real-Estate-Management-System/auth/register.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Sign Up</a>
            </li>
        <?php } ?>
    </ul>
</nav>

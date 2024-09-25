<nav style="background-color: #333; padding: 10px;">
    <ul style="list-style: none; margin: 0; padding: 0; display: flex; justify-content: center; position: relative;">
        <li style="margin: 0 15px;">
            <a href="/Real-Estate-Management-System/index.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Home</a>
        </li>
        <li style="margin: 0 15px;">
            <a href="/Real-Estate-Management-System/pages/about_us.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">About Us</a>
        </li>
        <li style="margin: 0 15px;">
            <a href="/Real-Estate-Management-System/pages/contact_us.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Contact Us</a>
        </li>
        <?php if (isset($_SESSION['role'])) { 
            // If the user is logged in, show specific links based on role
            if ($_SESSION['role'] == 'admin') { ?>
                <li style="margin: 0 15px;">
                    <a href="/admin/dashboard.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Admin Dashboard</a>
                </li>
            <?php } elseif ($_SESSION['role'] == 'owner') { ?>
                <li style="margin: 0 15px;">
                    <a href="/owner/my_properties.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">My Properties</a>
                </li>
            <?php } elseif ($_SESSION['role'] == 'customer') { ?>
                <li style="margin: 0 15px; position: relative;">
                <li style="margin: 0 15px;">
                    <a href="/Real-Estate-Management-System/customer/browse_properties.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Properties</a>
                </li>
                    <a href="#" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Account</a>
                    <ul style="list-style: none; margin: 0; padding: 10px 0; position: absolute; background-color: #444; top: 100%; left: 0; width: 150px; display: none; border-radius: 5px;">
                        <li><a href="/Real-Estate-Management-System/customer/edit_profile.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Edit Profile</a></li>
                        <li><a href="/Real-Estate-Management-System/customer/change_password.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Change Password</a></li>
                        <li><a href="/Real-Estate-Management-System/auth/logout.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Logout</a></li>
                    </ul>
                </li>
                <script>
                    const accountItem = document.querySelector('li:has(a[href="#"])');
                    accountItem.addEventListener('mouseover', () => {
                        accountItem.querySelector('ul').style.display = 'block';
                    });
                    accountItem.addEventListener('mouseleave', () => {
                        accountItem.querySelector('ul').style.display = 'none';
                    });
                </script>
            <?php }
        } else { ?>
            <li style="margin: 0 15px;">
                <a href="/Real-Estate-Management-System/auth/login.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Login</a>
            </li>
            <li style="margin: 0 15px;">
                <a href="/Real-Estate-Management-System/auth/register.php" style="text-decoration: none; color: white; padding: 10px 15px; display: inline-block; border-radius: 5px;">Sign Up</a>
            </li>
        <?php } ?>
    </ul>
</nav>

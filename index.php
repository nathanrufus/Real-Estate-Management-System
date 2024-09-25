<?php
session_start();
include 'includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CORE COMMERCIAL Real Estate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        main {
            padding: 40px 20px;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .cta {
            margin-top: 40px;
        }

        .cta a {
            display: inline-block;
            background-color: #007BFF;
            color: white;
            padding: 15px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            margin: 10px;
            transition: background-color 0.3s ease;
        }

        .cta a:hover {
            background-color: #0056b3;
        }

        .features {
            margin-top: 60px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .feature {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            text-align: center;
            margin-bottom: 20px;
        }

        .feature h3 {
            font-size: 22px;
            color: #333;
        }

        .feature p {
            font-size: 16px;
            color: #666;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <main>
        <h1>Welcome to CORE COMMERCIAL Real Estate</h1>
        <p>Your one-stop solution for buying, selling, and renting properties in the Northern and Western Suburbs. Explore our exclusive listings and get started today!</p>

        <section class="features">
            <div class="feature">
                <h3>Wide Property Listings</h3>
                <p>We offer a diverse range of properties to cater to all needs and budgets. Browse residential and commercial properties in prime locations.</p>
            </div>

            <div class="feature">
                <h3>Expert Guidance</h3>
                <p>Our team of expert real estate agents is here to help you with your property search, whether you're looking to buy, sell, or rent.</p>
            </div>

            <div class="feature">
                <h3>Seamless Process</h3>
                <p>We ensure a hassle-free and smooth experience from start to finish, whether you're a first-time buyer or a seasoned investor.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 CORE COMMERCIAL Real Estate. All Rights Reserved.</p>
    </footer>
</body>
</html>


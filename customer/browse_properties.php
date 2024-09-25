<?php
include '../config/db_connect.php';
include '../includes/header.php';
include '../includes/navbar.php';

$property_type = isset($_GET['type']) ? $_GET['type'] : '';
$city = isset($_GET['city']) ? $_GET['city'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "SELECT * FROM properties WHERE 1";
if ($property_type) {
    $sql .= " AND type_id = '$property_type'";
}
if ($city) {
    $sql .= " AND city_id = '$city'";
}
if ($status) {
    $sql .= " AND status = '$status'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Properties</title>
    <style>
        /* Main styles */
        main {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 32px;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto 40px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            display: block;
            width: 100%;
            background-color: #28a745;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #218838;
        }

        /* Property list styles */
        .properties-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .property-item {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .property-item h3 {
            font-size: 20px;
            color: #007BFF;
        }

        .property-item p {
            font-size: 14px;
            color: #666;
        }

        .property-item a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .property-item a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <main>
        <h1>Browse Properties</h1>
        <form method="GET" action="">
            <label for="type">Property Type:</label>
            <select name="type">
                <option value="">All</option>
                <?php
                $types = $conn->query("SELECT * FROM property_types");
                while ($type = $types->fetch_assoc()) {
                    echo "<option value='{$type['id']}'>{$type['name']}</option>";
                }
                ?>
            </select>

            <label for="city">City:</label>
            <select name="city">
                <option value="">All</option>
                <?php
                $cities = $conn->query("SELECT * FROM cities");
                while ($city = $cities->fetch_assoc()) {
                    echo "<option value='{$city['id']}'>{$city['name']}</option>";
                }
                ?>
            </select>

            <label for="status">Status:</label>
            <select name="status">
                <option value="">All</option>
                <option value="available">Available</option>
                <option value="sold">Sold</option>
                <option value="rented">Rented</option>
            </select>

            <button type="submit">Filter</button>
        </form>

        <div class="properties-list">
            <?php while ($property = $result->fetch_assoc()) { ?>
                <div class="property-item">
                    <h3><?php echo $property['title']; ?></h3>
                    <p><?php echo $property['description']; ?></p>
                    <a href="property_details.php?id=<?php echo $property['id']; ?>">View Details</a>
                </div>
            <?php } ?>
        </div>
    </main>
</body>
</html>

<?php include '../includes/footer.php'; ?>

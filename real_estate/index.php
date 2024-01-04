<?php

// Server connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "real_estate";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);



    $sql = "SELECT * FROM properties";
    $result = $conn->query($sql);

// Check if there are rows in the result




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to UrbanNest | Property Listings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 0;
            width: 100%;
            padding-left: 30px;
            position: fixed;
            text-align: left;
            z-index: 1;
        }

        .property-listing {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .property-listing a{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            text-decoration: none;
        }

        .property-card {
            width: 300px;
            margin: 5px;
            margin-top: 100px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .property-card:hover {
            transform: scale(1.05);
        }

        .property-image {
            width: 100%;
            height: 150px;
            background-size: cover;
            background-position: center;
            border-radius: 8px 8px 0 0;
        }

        .property-details {
            padding: 20px;
        }

        .property-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .property-description {
            color: #666;
            margin-bottom: 10px;
        }

        .property-price {
            font-size: 1.2em;
            color: #2ecc71; /* Green color for price */
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        <h1>UrbanNest Property Listings</h1>
    </header>

    <div class="property-listing">

        <?php

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $name = $row["p_name"] . "<br>";
                $desc = $row["p_desc"] . "<br>";
                $pricing = $row["p_pricing"] . "<br>";
                // $pricing = number_format($pricing);
                $image = $row["p_image"];

        ?>
        <a href="#propertylisting">
        <div class='property-card'>
            <div class="property-image" style="background-image: url(<?php echo $image;?>);"></div>
            <div class="property-details">
                <div class="property-title"><?php echo $name;?></div>
                <div class="property-description"><?php echo $desc;?></div>
                <div class="property-price"><?php echo $pricing;?></div>
            </div>
        </div>


        <?php
    }
} else {
    echo "No items found.";
}

        ?>  
        
        </div>        
        
        <!-- Add more property cards as needed -->

    <footer>
        &copy; 2024 Property Listings. Developed by Techstacity
    </footer>

</body>
</html>

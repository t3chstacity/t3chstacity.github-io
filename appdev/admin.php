<?php
// Check if the form is submitted
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "real_estate";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process form data
    $property_title = $_POST['property_title'];
    $property_description = $_POST['property_description'];
    $property_price = $_POST['property_price'];

    // Upload image
    $target_dir = "uploads/";
    $target_file = $target_dir.basename($_FILES["property_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["property_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["property_image"]["size"] > 55500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG,WEBP & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["property_image"]["tmp_name"], $target_file)) {
            // Insert data into the database
            $sql = "INSERT INTO properties (p_name, p_desc, p_pricing, p_image)
                    VALUES ('$property_title', '$property_description', '$property_price', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                $msg =  "Property added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        nav {
            background-color: #008B8B;
            padding: 15px;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
        }

        section {
            padding: 20px;
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

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #2a52be;
            
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #00308F;
        }
    </style>
</head>

<body>

    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <nav>
        <a href="#">Dashboard</a>
        <a href="#">Clients</a>
        <a href="#">Tenants</a>
        <a href="#">Settings</a>
        <a href="#">Logout</a>
    </nav>

    <section>
        
        <!-- Form for data entry -->
        <form action="" method="post" enctype="multipart/form-data">
        <label for="property_title">Property Title:</label>
        <input type="text" name="property_title" required>

        <label for="property_description">Property Description:</label>
        <textarea name="property_description" required></textarea>

        <label for="property_price">Property Price:</label>
        <input type="number" name="property_price" required>

        <label for="property_image">Property Image:</label>
        <input type="file" name="property_image" accept="image/*" required>

        <input type="submit" value="Upload Property">
    <?php echo $msg;?>
    </form>
    </section>

    <footer>
        <p>&copy; 2024 Admin Dashboard</p>
    </footer>

</body>

</html>

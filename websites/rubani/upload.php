<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rubani";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg ="";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {

    // Specify the target directory where the file will be uploaded
    $targetDirectory = "uploads/";

    // Get the file name
    $fullname = basename($_FILES["image"]["name"]);

    $desc = $_POST['description'];
    $price = $_POST['price'];

    // Specify the target file path
    $targetFilePath = $targetDirectory . $fullname;

    // Get the file extension
    $fileExtension = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allowed file types
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");

    // Check if the file type is allowed
    if (in_array($fileExtension, $allowedExtensions)) {

        // Upload file to the specified directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {

            // Insert data into the database
            $insertSql = "INSERT INTO aircrafts (fullname, image, description, price) VALUES ('$fullname', '$targetFilePath','$desc','$price')";
            if ($conn->query($insertSql) === TRUE) {
                $msg = "The file " . $fullname . " has been uploaded and information has been added to the database.";
            } else {
                echo "Sorry, there was an error uploading your file and adding to the database: " . $conn->error;
            }

        } else {
            echo "Sorry, there was an error uploading your file.";
        }

    } else {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubani | Add an Aircraft</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="image">Select Image:</label>
    <input type="file" name="image" id="image" required>
    <input type="text" name="description" id="description" required>
    <input type="text" name="price" id="price" required>
    <?php echo $msg;?>
    <button type="submit" name="submit">Upload</button>
</form>

</body>
</html>

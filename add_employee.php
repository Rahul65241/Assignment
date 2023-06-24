<?php
// Database connection credentials
$hostname = 'localhost';
$username = 'your_username';
$password = 'your_password';
$database = 'your_database';

// Establish a connection to the MySQL server
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data and sanitize inputs
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $experience = mysqli_real_escape_string($connection, $_POST['experience']);
    $department = mysqli_real_escape_string($connection, $_POST['department']);
    $education = mysqli_real_escape_string($connection, $_POST['education']);
    $hobby = mysqli_real_escape_string($connection, $_POST['hobby']);

    // Handle file upload
    $targetDir = "photos/";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Error: File is not an image.";
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "Error: File already exists.";
        $uploadOk = 0;
    }

    // Check file size (max 2MB)
    if ($_FILES["photo"]["size"] > 2097152) {
        echo "Error: File is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png" && $imageFileType !== "gif") {
        echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // If all checks pass, upload the file
    if ($uploadOk === 1) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // Store employee data in the database
            $query = "INSERT INTO employees (name, email, gender, contact, address, experience, department, education, hobby, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 'sssssissss', $name, $email, $gender, $contact, $address, $experience, $department, $education, $hobby, $targetFile);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Redirect back to the index page after successful submission
            header("Location: index.php");
            exit();
        } else {
            echo "Error: Failed to upload file.";
        }
    }
}

// Close the database connection
mysqli_close($connection);
?>

<?php
// Handle file upload process
$targetDir = "photos/";
$targetFile = $targetDir . basename($_FILES["photo"]["name"]);
$uploadOk = true;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if the file is an actual image
$check = getimagesize($_FILES["photo"]["tmp_name"]);
if ($check === false) {
    die("File is not an image.");
    $uploadOk = false;
}

// Check if file already exists
if (file_exists($targetFile)) {
    die("Sorry, file already exists.");
    $uploadOk = false;
}

// Check file size (max 5MB)
if ($_FILES["photo"]["size"] > 5 * 1024 * 1024) {
    die("Sorry, your file is too large.");
    $uploadOk = false;
}

// Allow only certain file formats (e.g., JPEG, PNG)
if ($imageFileType !== "jpg" && $imageFileType !== "png") {
    die("Sorry, only JPG, JPEG, and PNG files are allowed.");
    $uploadOk = false;
}

// Move uploaded file to destination directory
if ($uploadOk) {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        // File uploaded successfully
        // Perform any additional operations if needed
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}
?>

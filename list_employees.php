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

// Retrieve employee data from the database
$query = "SELECT * FROM employees";
$result = mysqli_query($connection, $query);

// Display the list of employees
echo "<ul>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>" . $row['name'] . "</li>";
    // Display other employee information as desired
}
echo "</ul>";

// Close the result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($connection);
?>

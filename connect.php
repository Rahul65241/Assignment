 <?php
$name = $_POST["name"];
  $email = $_POST["age"];
  $gender = $_POST["gender"];
  $contact = $_POST["contact"];
  $address = $_POST["address"];
  $experience = $_POST["experience"];
  $department = $_POST["department"];
  $education = $_POST["education"];
  $hobby = $_POST["hobby"];
  $photo = $_POST["photo"];

$conn = new mysqli('localhost','root','','rahul_kumar');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	}
 $query = "INSERT INTO tb_data VALUES('', '$name', '$age', '$country', '$gender', '$language')";
  mysqli_query($conn,$query);
  $query = "SELECT * FROM employees";
$result = mysqli_query($connection, $query);

echo "<ul>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>" . $row['name'] . "</li>";
}
echo "</ul>";

mysqli_free_result($result);
}
?>




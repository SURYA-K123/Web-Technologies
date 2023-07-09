<?php
$username = $_POST['email'];
$password = $_POST['password'];

$servername = "localhost";
$dbusername = "root";
$dbpassword = "Surya@4111";
$dbname = "web";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    include('index.html');
} else {
    echo "<script> document.getElementById('invalid').style.visibility ='visible'; </script>";
}
$conn->close();
?>

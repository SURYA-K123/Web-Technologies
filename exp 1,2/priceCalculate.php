<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "Surya@4111";
$dbname = "web";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT SUM(PRICE*QUANTITY) AS total FROM cart_items";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalPrice = $row['total'];
    echo $totalPrice;

} else {
    echo "0";
}

$conn->close();
?>

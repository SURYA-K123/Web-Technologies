<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "Surya@4111";
$dbname = "web";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MED_ID']) && isset($_POST['QUANTITY'])) {
    $med_id = $_POST['MED_ID'];
    $updated_quantity = $_POST['QUANTITY'];

    $sql = "UPDATE cart_items SET QUANTITY = $updated_quantity WHERE MED_ID = $med_id";

    if ($conn->query($sql) === TRUE) {
        echo "Quantity updated successfully.";
    } else {
        echo "Error updating quantity: " . $conn->error;
    }
}

$conn->close();
?>

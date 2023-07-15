<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "Surya@4111";
$dbname = "web";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MED_ID'])) {
    $med_id = $_POST['MED_ID'];

    $stmt = $conn->prepare("DELETE FROM cart_items WHERE MED_ID = ?");
    $stmt->bind_param("i", $med_id); 

    if ($stmt->execute()) {
        echo "Item deleted successfully from cart.";
    } else {
        echo "Error deleting item from cart: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

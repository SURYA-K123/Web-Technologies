<?php
$servername = "localhost";
$username = "root";
$password = "Surya@4111";
$database = "web";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['Submit'])) {
    if (isset($_POST['medicine']) && isset($_POST['pieces']) && isset($_POST['price']) && isset($_POST['dosage'])) {
        $input1 = $_POST['medicine'];
        $input2 = (int)$_POST['pieces'];
        $input3 = (int)$_POST['price'];
        $input4 = $_POST['dosage'];

        $sql = "INSERT INTO MEDICINE (MED_NAME, PIECES, PRICE, DOSAGE) VALUES ('$input1', '$input2', '$input3', '$input4')";
        if ($conn->query($sql) === TRUE) {
            echo "Record inserted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>


<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "Surya@4111";
$dbname = "web";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cart_items";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $column0 = $row["MED_ID"];
        $column1 = $row["MED_NAME"];
        $column3 = $row["PRICE"];
        $column4 = $row["QUANTITY"];
        $column5 = $row['IMAGE'];
        echo "<div class='cards' id='$column0' style='height:475px'>";
        echo "<img src='$column5' alt=''>";
        echo "<p class='product-name'>$column1</p>";
        echo "<p class='price'>INR $column3</p>";
        echo "<p class='quantity'>Quantity :<span>$column4<span></p>";
        echo "<button class='add' onclick='addQuantity(event)'>Add</button>";
        echo "<button class='sub' onclick='subQuantity(event)'>Subtract</button>";
        echo "<button class='removebtn' id='$column0' onclick='abc(event)'>Remove</button>";
        echo "</div>";

    }
} 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MED_ID']) && isset($_POST['QUANTITY'])) {
    $med_id = $_POST['MED_ID'];
    $quantity = $_POST['QUANTITY'];
    $sql = "SELECT MED_ID, MED_NAME,IMAGE ,PRICE FROM medicine WHERE MED_ID = $med_id";
    $result = $conn->query($sql);
    $sql2 = "SELECT * FROM cart_items WHERE MED_ID = $med_id";
    $result2 = $conn->query($sql2);
    if ($result2 && $result2->num_rows == 0) {
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $med_name = $row['MED_NAME'];
            $price = $row['PRICE'];
            $img = $row['IMAGE'];
            $sql = "INSERT INTO cart_items (MED_ID, MED_NAME, PRICE, QUANTITY, `IMAGE`) VALUES ('$med_id', '$med_name', '$price', '$quantity', '$img')";
            $conn->query($sql);
        }
    }
}

?>
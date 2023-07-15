<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "Surya@4111";
$dbname = "web";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM medicine";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $searchInput = $_POST['search'];
    $sql = "SELECT * FROM medicine WHERE MED_NAME LIKE '%$searchInput%'"; // Use LIKE to search for partial matches
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $column0 = $row["MED_ID"];
        $column1 = $row["MED_NAME"];
        $column2 = $row["PIECES"];
        $column3 = $row["PRICE"];
        $column4 = $row["DOSAGE"];
        $sql2 = "SELECT * FROM cart_items WHERE MED_ID = $column0";
    $result2 = $conn->query($sql2);

        echo "<div class='cards' id='$column0'>";
        echo "<img src='./items.webp' alt=''>";
        echo "<p class='product-name'>$column1</p>";
        echo "<p class='price'>INR $column3</p>";
        if($result2->num_rows>0)
        {
            echo "<p class='cartStatus'> Medicine added to Cart</p>";
        }
        else{
        echo "<button class='addToCart' onclick='add(event)'>Add to cart</button>";
        }
        echo "</div>";
    }
} else {
    echo "No matching records found.";
}

$conn->close();
?>
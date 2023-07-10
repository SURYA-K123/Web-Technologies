<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: "calibri";
        /* background-image: url("./back1.jpg"); */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }

    header {
        height: 80px;
        width: 100%;
        top: 0;
        left: 0;
        position: fixed;
        background-image: linear-gradient(to right, rgb(0, 132, 255), rgb(45, 218, 45));
        justify-content: center;
        align-items: center;
        display: flex;
        z-index: 1;
    }

    #logo {
        height: 55px;
        width: 55px;
        border-radius: 100%;
    }

    main {
        position: relative;
        margin-top: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    input[type="text"] {
        height: 35px;
        width: 300px;
        border: 3px solid gray;
        border-radius: 3px;
        outline: none;
        transition: 0.5s;
    }
    input[type="text"]:focus
    {
        border: 4px solid rgb(53, 68, 207);
    }
    input[type="submit"]
    {
        height: 40px;
        color: white;
        background-color: blue;
        border: none;
        width: 100px;
        border-radius: 3px;
        cursor: pointer;
    }
    #content
    {
        position: relative;
        margin-top: 30px;
        width: 90%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content:space-around; 
    }
    #card {
        width: 265px;
        height: 350px;
        border-radius: 5px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center;
        background-color: white;
        margin-right: 10px;
        margin-top: 30px;
}
</style>

<body>
    <header>
        <header>
            <img src="./logo.jpg" alt="logo" id="logo">
            <h1 style="margin-left: 10px;">Rithish Medical Store</h1>
        </header>
    </header>
    <main>
        <div id="searchbar">
            <form action="" method="post">
                <input type="text" name="medicine" placeholder="Enter medicine to Search">
                <input type="submit" value="Search">
            </form>
        </div>
        <div id="content">
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
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $column1 = $row["MED_NAME"]; 
                $column2 = $row["PIECES"]; 
                $column3 = $row["PRICE"];
                $column4 = $row["DOSAGE"];

                echo "<div id='card'>";
                echo "<p>Medicine :$column1</p>";
                echo "<p>No of pieces :$column2</p>";
                echo "<p>Price :$column3</p>";
                echo "<p>Dosage :$column4</p>";
                echo "</div>";
            }
        } else {
            echo "No data found.";
        }
        $conn->close();
        ?>

        </div>
    </main>
</body>

</html>
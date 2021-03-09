<?php 
    $data = json_decode(file_get_contents('php://input'), true);
    $tableNum = $data["tableNum"];
    $order = $data["order"];
    $subtotal = $data["subtotal"];
    $total = $data["total"];

    $servername = "localhost";
    $username = "user";
    $password = "password";
    $dbname = "restaurant";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Table: " . $row["tableNum"]. " - Order: " . $row["order"]. " - Subtotal: " . $row["subtotal"]. " - Total: " . $row["total"]. "<br><br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
?>
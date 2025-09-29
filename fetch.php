<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_menu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Item Name</th><th>Price (₹)</th><th>Category</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["item_name"]."</td><td>".$row["price"]."</td><td>".$row["category"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No menu items available.";
}
$conn->close();
?>

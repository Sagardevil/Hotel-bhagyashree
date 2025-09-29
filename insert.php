<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "hotel_menu";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die(json_encode(["success" => false, "message" => "DB connection failed"])); }

$data = json_decode(file_get_contents("php://input"), true);
$items = $data['items'];
$total = $data['total'];

$sql = "INSERT INTO orders (total_amount) VALUES ($total)";
if ($conn->query($sql) === TRUE) {
    $order_id = $conn->insert_id;

    foreach ($items as $item) {
        $name = $conn->real_escape_string($item['name']);
        $qty = intval($item['qty']);
        $price = floatval($item['price']);
        $conn->query("INSERT INTO order_items (order_id, item_name, qty, price) 
                      VALUES ($order_id, '$name', $qty, $price)");
    }

    echo json_encode(["success" => true, "order_id" => $order_id]);
} else {
    echo json_encode(["success" => false, "message" => $conn->error]);
}

$conn->close();
?>

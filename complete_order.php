<?php
include 'db.php';

$orderId = intval($_POST['order_id']);

$sql = "UPDATE orders SET status='completed' WHERE id=$orderId";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Order marked as completed"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>

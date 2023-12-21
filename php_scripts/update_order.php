<?php
$order_id = $_POST['order_id'];

$conn = new mysqli("localhost", "root", "", "cinema_db");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE orders SET status='2' WHERE id = ?");

$stmt->bind_param("i", $order_id);

if ($stmt->execute()) {
  echo "Order confirmed successfully";
} else {
  echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
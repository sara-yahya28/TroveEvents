<?php
header("Content-Type: application/json");

// connect to DB
$conn = new mysqli("localhost", "root", "", "your_db"); // change your_db to actual db name
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "DB connection failed"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$customerName = $data['customer_name'];
$reservationDetails = json_encode($data['reservation_details'], JSON_UNESCAPED_UNICODE);
$total = $data['total'];

$stmt = $conn->prepare("INSERT INTO orders (customer_name, reservation_details, total) VALUES (?, ?, ?)");
$stmt->bind_param("ssd", $customerName, $reservationDetails, $total);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "order_id" => $stmt->insert_id]);
} else {
    echo json_encode(["success" => false, "message" => "Save failed"]);
}

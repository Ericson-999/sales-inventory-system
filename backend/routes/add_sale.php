<?php
include '../config/db_connect.php';
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !is_array($data)) {
  http_response_code(400);
  echo json_encode(["success" => false, "error" => "Invalid or missing JSON payload"]);
  exit;
}

$reference_number = $data['reference_number'] ?? uniqid('ref_');
$customer_id = $data['customer_id'] ?? null;
$staff_id = $data['staff_id'] ?? ($_SESSION['user_id'] ?? null);
$payment_method = $data['payment_method'] ?? 'Cash';
$remarks = $data['remarks'] ?? '';
$items = $data['items'] ?? [];

try {
  foreach ($items as $item) {
    $product_id = $item['product_id'] ?? null;
    $qty = $item['qty'] ?? 0;
    $price = $item['price'] ?? null;

    if (!$product_id || !$price || $qty <= 0) {
      continue;
    }

    $stmt = $conn->prepare("INSERT INTO sales 
      (reference_number, product_id, quantity, price, customer_id, staff_id, payment_method, remarks) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
      throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("siidisss", 
      $reference_number, 
      $product_id, 
      $qty, 
      $price, 
      $customer_id, 
      $staff_id, 
      $payment_method, 
      $remarks
    );

    if (!$stmt->execute()) {
      throw new Exception("Execute failed: " . $stmt->error);
    }
  }

  echo json_encode(["success" => true]);

} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>

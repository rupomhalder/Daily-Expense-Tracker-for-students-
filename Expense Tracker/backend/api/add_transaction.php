<?php
session_start();
 require_once "../src/routes/db.php";// your DB connection file

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Not logged in"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = $_SESSION['user_id'];
    $type = $_POST['transaction_type'];
    $desc = $_POST['transaction_description'];
    $amount = $_POST['transaction_amount'];

    $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, description, amount) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$userId, $type, $desc, $amount])) {
        echo json_encode(["success" => true, "id" => $pdo->lastInsertId()]);
    } else {
        echo json_encode(["success" => false, "message" => "DB insert failed"]);
    }
}
?>
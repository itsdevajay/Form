<?php

session_start();

header("Content-Type: application/json");

require_once "../controllers/FormController.php";

$id = $_POST['id'];
$userId = $_SESSION['user']['id'];

$controller = new FormController();

$result = $controller->changeStatus(
    $id,
    3,                      // Admin Pending
    $userId,
    "Approved by Manager"
);

echo json_encode([
    "success" => $result,
    "message" => $result
        ? "Form Approved Successfully."
        : "Approval Failed."
]);

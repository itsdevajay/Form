<?php

session_start();

header("Content-Type: application/json");

require_once "../controllers/FormController.php";

$formId = $_POST['id'];

$userId = $_SESSION['user']['id'];

$controller = new FormController();

$result = $controller->changeStatus(
    $formId,
    4,                  // Approved
    $userId,
    "Approved by Admin"
);

echo json_encode([
    "success"=>$result,
    "message"=>$result
        ? "Form Approved Successfully."
        : "Unable to approve form."
]);

<?php

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    echo json_encode([
        "success" => false,
        "message" => "Please login first."
    ]);
    exit;
}

require_once __DIR__ . "/../controllers/LeaveController.php";

$controller = new LeaveController();

$result = $controller->save($_POST, $_SESSION['user']);

echo json_encode($result);

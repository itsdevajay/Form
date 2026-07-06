<?php

session_start();

header("Content-Type: application/json");

require_once __DIR__ . "/../controllers/FormController.php";

$id = $_GET['id'] ?? 0;

$controller = new FormController();

$data = $controller->getFormById($id);

echo json_encode($data);

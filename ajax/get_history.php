<?php

session_start();

header("Content-Type: application/json");

require_once "../controllers/WorkflowController.php";

$formId = $_GET['id'];

$controller = new WorkflowController();

$data = $controller->getHistory($formId);

echo json_encode($data);

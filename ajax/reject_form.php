<?php

session_start();

header("Content-Type: application/json");

require_once __DIR__ . "/../controllers/FormController.php";

$id = $_POST['id'];
$remark = trim($_POST['remark']);

if ($remark == "") {
    echo json_encode([
        "success" => false,
        "message" => "Remark is required."
    ]);
    exit;
}

$controller = new FormController();

$result = $controller->rejectByManager($id, $remark);

echo json_encode([
    "success" => $result,
    "message" => $result ? "Form Rejected Successfully." : "Unable to Reject Form."
]);

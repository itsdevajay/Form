<?php

session_start();

header("Content-Type: application/json");

require_once "../controllers/FormController.php";

$id = $_POST['id'];

$userId = $_SESSION['user']['id'];
$roleId = $_SESSION['user']['role_id'];

if ($roleId == 1)
{
    // Employee → Manager Pending
    $newStatus = 2;
    $remark = "Submitted by Employee";
}
elseif ($roleId == 2)
{
    // Manager → Admin Pending
    $newStatus = 3;
    $remark = "Submitted by Manager";
}
else
{
    echo json_encode([
        "success" => false,
        "message" => "Invalid Role"
    ]);
    exit;
}

$controller = new FormController();

$result = $controller->changeStatus(
    $id,
    $newStatus,
    $userId,
    $remark
);

echo json_encode([
    "success" => $result,
    "message" => $result
        ? "Form Submitted Successfully."
        : "Submit Failed."
]);

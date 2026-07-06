<?php

session_start();

header("Content-Type: application/json");

require_once __DIR__."/../controllers/FormController.php";

$controller = new FormController();

$data = $controller->getAdminForms();

foreach($data as &$row)
{
    $row['action']='

        <button class="btn btn-primary btn-sm viewForm"
                data-id="'.$row['id'].'">
            View
        </button>

        <button class="btn btn-success btn-sm adminApprove"
                data-id="'.$row['id'].'">
            Approve
        </button>

        <button class="btn btn-danger btn-sm adminReject"
                data-id="'.$row['id'].'">
            Reject
        </button>

    ';
}

echo json_encode([
    "data"=>$data
]);

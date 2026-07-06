<?php

session_start();

require_once __DIR__ . "/../controllers/FormController.php";

header('Content-Type: application/json');

$user = $_SESSION['user'];

$controller = new FormController();

$data = $controller->getMyForms($user['id']);

foreach ($data as &$row) {
    if($row['status_name']=="Draft"){

        $row['action']='
        <button class="btn btn-info btn-sm viewForm" data-id="'.$row['id'].'">
        View
        </button>

        <button class="btn btn-warning btn-sm editForm" data-id="'.$row['id'].'">
        Edit
        </button>

        <button class="btn btn-success btn-sm submitForm" data-id="'.$row['id'].'">
        Submit
        </button>

        <button class="btn btn-danger btn-sm deleteForm" data-id="'.$row['id'].'">
        Delete
        </button>

        ';

    }
    else{
        $row['action']='
        <button class="btn btn-info btn-sm viewForm"
        data-id="'.$row['id'].'">
        View
        </button>
        ';

    }
}

echo json_encode([
    "data" => $data
]);

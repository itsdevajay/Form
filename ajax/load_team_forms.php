<?php

session_start();

header("Content-Type: application/json");

require_once __DIR__."/../controllers/FormController.php";

$user=$_SESSION['user'];

$controller=new FormController();

$data=$controller->getTeamForms($user['id']);

foreach($data as &$row)
{
    $row['action']='

    <button class="btn btn-info btn-sm viewForm"
    data-id="'.$row['id'].'">
    View
    </button>

    <button class="btn btn-success btn-sm approveForm"
    data-id="'.$row['id'].'">
    Approve
    </button>

    <button class="btn btn-danger btn-sm rejectForm"
    data-id="'.$row['id'].'">
    Reject
    </button>

    ';
}

echo json_encode([
    "data"=>$data
]);

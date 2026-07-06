<?php

require_once "../controllers/FormController.php";

$controller = new FormController();

$data = $controller->load();

foreach ($data as $row) {
    echo "<p>$row</p>";
}

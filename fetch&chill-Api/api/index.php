<?php
header("Content-Type: application/json");

include '../config/pet_connection.php';
include '../controller/petrecordscontroller.php';

$controller = new PetRecordController($conn);
$controller->handleRequest();

$conn->close();
?>
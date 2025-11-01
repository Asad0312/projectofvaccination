<?php
include "DBConnection.php";

if (isset($_GET['id'])) {
    $doctorId = $_GET['id'];
    $query = "SELECT * FROM doctordetail WHERE id = '$doctorId'";
    $result = mysqli_query($connection, $query);
    
    if ($doctor = mysqli_fetch_assoc($result)) {
        header('Content-Type: application/json');
        echo json_encode($doctor);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Doctor not found']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Doctor ID required']);
}
?>
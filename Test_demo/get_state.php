<?php
include 'includes/connexion.php';

$result = $conn->query("SELECT Button_state, click_pilot, click_tour FROM Button_state WHERE ID_Button=1");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $row['Button_state'] = strtolower($row['Button_state']);
    echo json_encode($row);
} else {
    echo json_encode([
        "Button_state" => "rouge",
        "click_pilot" => 0,
        "click_tour" => 0
    ]);
}

$conn->close();
?>
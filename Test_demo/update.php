<?php
include 'includes/connexion.php';

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$user = $_POST['user'] ?? null;

if (!$user) {
    die("Erreur : Aucun utilisateur spécifié.");
}

$result = $conn->query("SELECT Button_state FROM Button_state WHERE ID_Button=1");
$row = $result->fetch_assoc();
$current_state = strtolower($row['Button_state']);

if ($user === "pilote" && $current_state === "red") {
    $conn->query("UPDATE Button_state SET Button_state='Orange', click_pilot=1 WHERE ID_Button=1");
    echo "Bouton mis à jour en ORANGE.";
}

if ($user === "tour" && $current_state === "orange") {
    $conn->query("UPDATE Button_state SET Button_state='Green', click_tour=1 WHERE ID_Button=1");
    echo "Bouton mis à jour en VERT.";
}

$conn->close();
?>

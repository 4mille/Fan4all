<?php
include 'includes/connexion.php';

// Vérifier si la connexion est bien établie
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupérer les valeurs envoyées via la requête POST
$id_pilote = $_POST['id_pilote'] ?? null;
$id_control = $_POST['id_control'] ?? null;
$status = $_POST['status'] ?? 'En attente'; // Statut par défaut

// Vérifier si les ID sont valides
if (!$id_pilote || !$id_control) {
    die("Erreur : ID Pilote ou ID Contrôleur manquant.");
}

// Insérer une nouvelle conversation
$sql = "INSERT INTO conversation (ID_Pilote, ID_control, Status) 
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $id_pilote, $id_control, $status);

if ($stmt->execute()) {
    echo "Conversation créée avec succès.";
} else {
    echo "Erreur lors de la création de la conversation : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

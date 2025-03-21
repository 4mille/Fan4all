<?php
include 'includes/connexion.php';

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
echo "Connexion réussie.<br>";

// Vérifier que la table existe
$checkTable = $conn->query("SHOW TABLES LIKE 'Button_state'");
if ($checkTable->num_rows == 0) {
    die("Erreur: La table 'Button_state' n'existe pas !");
}

// Vérifier si la colonne ID_Button=1 existe
$checkButton = $conn->query("SELECT * FROM Button_state WHERE ID_Button=1");
if ($checkButton->num_rows == 0) {
    die("Erreur: Aucun bouton trouvé avec ID_Button=1 !");
}

// Exécuter la requête de réinitialisation
$sql = "UPDATE Button_state SET Button_state='Red', click_pilot=0, click_tour=0 WHERE ID_Button=1";
if ($conn->query($sql) === TRUE) {
    echo "✔️ Réinitialisation réussie : état = ROUGE.";
} else {
    die("Erreur SQL (UPDATE) : " . $conn->error);
}

$conn->close();
?>

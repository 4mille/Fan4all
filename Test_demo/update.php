<?php
include 'includes/connexion.php'; // Connexion à la base

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$user = $_POST['user'] ?? null; // Récupère le rôle (pilote ou tour)

if (!$user) {
    die("Erreur : Aucun utilisateur spécifié.");
}

// Vérifie si une conversation active existe déjà
$checkConv = $conn->query("SELECT ID_conv FROM Conversation WHERE State = 0 LIMIT 1");

if ($user === "pilote") {
    if ($checkConv->num_rows === 0) {
        // Aucune conversation active -> Créer une nouvelle
        $createConv = $conn->query("
            INSERT INTO Conversation (ID_Pilote, ID_controle, ID_Tour, State, Current_state)
            VALUES (1, NULL, NULL, 0, 'Pilote a contacté la tour')
        ");

        if ($createConv) {
            echo "Nouvelle conversation créée.";
        } else {
            die("Erreur lors de la création de la conversation : " . $conn->error);
        }
    } else {
        echo "Conversation déjà en cours.";
    }

    // Mettre à jour le bouton en ORANGE
    $conn->query("UPDATE Button_state SET Button_state='Orange', click_pilot=1 WHERE ID_Button=1");
    echo "Bouton mis à jour en ORANGE.";
}

if ($user === "tour") {
    // Vérifier si une conversation est en cours et que la tour clique
    if ($checkConv->num_rows > 0) {
        $conv = $checkConv->fetch_assoc();
        $conn->query("UPDATE Conversation SET State = 1 WHERE ID_conv = " . $conv['ID_conv']);
        echo "La conversation est maintenant validée.";
    }

    // Mettre à jour le bouton en VERT
    $conn->query("UPDATE Button_state SET Button_state='Green', click_tour=1 WHERE ID_Button=1");
    echo "Bouton mis à jour en VERT.";
}

$conn->close();
?>

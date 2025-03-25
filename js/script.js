$(document).ready(function () {
    function updateButton() {
        $.get("../get_state.php", function (data) {
            let response = JSON.parse(data);
            let button = $("#hello");
            let colorMap = {"red": "rouge", "orange": "orange", "green": "vert"};
            let stateClass = colorMap[response.Button_state] || "rouge";

            button.removeClass("rouge orange vert").addClass(stateClass);
            let userRole = button.data("user");

            if ((stateClass === "rouge" && userRole === "pilote") || 
                (stateClass === "orange" && userRole === "tour")) {
                button.prop("disabled", false);
            } else {
                button.prop("disabled", true);
            }
        });
    }

    $("#hello").click(function () {
        $.post("../update.php", { user: $(this).data("user") }, function () {
            updateButton();
        });

        // Définir les IDs Pilote et Contrôleur pour créer la conversation
        let idPilote = 1; // Exemple : ID Pilote (remplace par l'ID dynamique)
        let idControleur = 2; // Exemple : ID Contrôleur (remplace par l'ID dynamique)

        // Envoie de la requête pour créer la conversation
        $.post("../create_conversation.php", { 
            id_pilote: idPilote, 
            id_control: idControleur, 
            status: 'En attente' 
        }, function (response) {
            console.log(response); // Affiche la réponse du serveur
        });
    });

    setInterval(updateButton, 2000);
});

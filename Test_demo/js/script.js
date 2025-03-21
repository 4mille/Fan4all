$(document).ready(function () {
    function updateButton() {
        $.get("../get_state.php", function (data) {
            console.log("Réponse AJAX GET:", data); // DEBUG

            let response = JSON.parse(data);
            let button = $("#hello");

            let colorMap = {
                "red": "rouge",
                "orange": "orange",
                "green": "vert"
            };

            let stateClass = colorMap[response.Button_state] || "rouge";

            button.removeClass("rouge orange vert").addClass(stateClass);

            if ((stateClass === "rouge" && response.click_pilot == 0) ||
                (stateClass === "orange" && response.click_tour == 0)) {
                button.prop("disabled", false);
            } else {
                button.prop("disabled", true);
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log("Erreur AJAX GET:", textStatus, errorThrown); // DEBUG
        });
    }

    $("#hello").click(function () {
        console.log("Bouton cliqué !"); // DEBUG

        $.post("../update.php", { user: $(this).data("user") }, function (response) {
            console.log("Réponse AJAX POST:", response); // DEBUG
            updateButton();
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log("Erreur AJAX POST:", textStatus, errorThrown); // DEBUG
        });
    });

    setInterval(updateButton, 2000);
});

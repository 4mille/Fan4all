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
    });

    setInterval(updateButton, 2000);
});
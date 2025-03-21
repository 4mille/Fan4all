<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Réinitialisation</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        button {
            font-size: 20px;
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <h1>Page Admin</h1>
    <p>Cliquez sur le bouton ci-dessous pour réinitialiser la conversation.</p>
    <button id="reset">Réinitialiser</button>

    <script>
        $("#reset").click(function() {
            console.log("Bouton cliqué, envoi AJAX...");
            $.post("../reset.php", function(response) {
                console.log("Réponse de reset.php :", response); // DEBUG
                alert(response);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Erreur AJAX :", textStatus, errorThrown);
                alert("Erreur lors de la réinitialisation !");
            });
        });
    </script>
</body>
</html>

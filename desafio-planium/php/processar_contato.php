<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Processamento de Contato</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
    <div id="principal">

    <h1>Processamento de contato</h1>

    <hr>

    <?php
        session_start();

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        //die();
        header("location: infos_planos.php");

    ?>

    </div>
</body>
</html>
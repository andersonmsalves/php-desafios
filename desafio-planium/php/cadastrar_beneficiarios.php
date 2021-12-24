<?php
    session_start();

    $numero_vidas = $_SESSION['numero_vidas'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro dos Beneficiarios</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
    <div id="principal">

    <h1>Página de Cadastro dos Beneficiarios</h1>

    <hr>

    <?php
        /*echo "<pre>";
        var_dump($_SESSION);
        echo "</pre>";

        echo "<hr>";*/
    ?>

    <form action="validar_dados_beneficiarios.php" method="post">
        
        <fieldset>
            <legend class="legend-fieldset-destaque">Dados dos Beneficiarios</legend>
            <?php
                for($i=1; $i <= $numero_vidas; $i++){
                    echo "<div class='dado-beneficiario'>";
                    echo "<fieldset>";
                    echo "<legend style='border:none'>Dados do beneficiario $i:</legend>";
                    echo "<label class='label-campo'>Nome:</label>";
                    echo "<input type='text' class='campo' name='nomes_beneficiarios[]' required placeholder=\"Insira o nome do $i" . "º beneficiario\">";
                    echo "<label class='label-campo'>Idade:</label>";
                    echo "<input type='number' class='campo' name=\"idades_beneficiarios[]\" min='1' max='70' step='1' value='20'>";
                    echo "</fieldset>";
                    echo "</div>";
                }
            ?>
            
            
        </fieldset>
        

        <button type="submit" class="btn-enviar" name="enviar-dados-beneficiarios">Enviar</button>
        <div style="clear:both"></div>
    </form>
    
    </div><?php //fim div principal ?>
</body>
</html>
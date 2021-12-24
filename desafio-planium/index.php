<?php
    session_start();

    if(!isset($_SESSION['status_cadastro_anterior'])){
        $_SESSION['status_cadastro_anterior'] = null;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio Planium</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">

    <style type="text/css">
        p{
            width: 50%;
            margin: 15px auto;
            padding: 8px;
            background-color: lightgray;
            border-radius: 10px;
            text-align: justify;
            font-style: italic;
        }

        input{
            text-align: center;
            border: 1px solid blue;
        }
    </style>
</head>
<body>
    <div id="principal">

        <h1> Planium </h1>
        <h3> Descomplicando a forma de contratar planos de saúde</h3>

        <hr>

        <p> 
            Menos burocracia na hora de contratar um plano de saúde. Evite aborrecimentos e poupe seu tempo
        </p>
        
        <hr>

        <?php 
            if($_SESSION['status_cadastro_anterior'] != null){
                echo "<label><span style='margin: 50px auto; background-color: lightgray; font-style:italic; padding: 2px;'>
                Cadastro anterior realizado com sucesso</span></label>";
                echo "<hr>";
            }

            $_SESSION['status_cadastro_anterior'] = null;
        ?>

        <form action="php/processar_contato.php" method="post">

            <fieldset>
                <legend> Dados para contato:</legend>
                <label for name="nome_contato">Nome: </label>
                <input type="text" name="nome_contato" required placeholder="Insira aqui seu nome">

                <label for="email">E-mail:</label>
                <input type="email" name="email" placeholder="Insira aqui seu melhor e-mail" required>

                <label for="telefone">Telefone:</label>
                <input type="fone" name="telefone" placeholder="(xx)xxxx-xxxx" required>
            </fieldset>

            <button type="submit" class="btn-enviar" name="btn-enviar-dados-contato">Enviar/Acessar</button>
            <div style="clear:both"></div>
        </form>

    </div>
</body>
</html>
<?php
    session_start();

    //Obter dados de arquivos JSON no formato string:
    $dados_planos = file_get_contents("../data/json/plans.json");
    $dados_precos = file_get_contents("../data/json/prices.json");

    // Transformar os dados em Arrays:
    $array_planos = json_decode($dados_planos);
    $array_precos = json_decode($dados_precos);

    // Criar copias dos arrays anteriores para ficarem visiveis para as outras páginas:
    // Implementação 23/12/2021:
    $_SESSION['array_planos'] = $array_planos;
    $_SESSION['array_precos'] = $array_precos;

    //echo "<pre>";
    //print_r($array_planos);
    //echo "</pre>";

    $_SESSION['planos_disponiveis'] = array();
    
    if(!isset($_SESSION['nome_plano_error'])){
        $_SESSION['nome_plano_error'] = null;
    } 

    // Implementação 23/12/2021:
    if(!isset($_SESSION['qtd_beneficiarios_error'])){
        $_SESSION['qtd_beneficiarios_error'] = null;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Seleção do Plano de Saúde</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
    <div id="principal">

    <h1>Página de Seleção do Plano de Saúde</h1>

    <hr>

    <div id="container-tabela">
    
        <table border='1'> 
            <caption>Planos Disponíveis</caption>
            <thead>
                <tr>
                    <th>Nome do Plano</th>
                    <th>Registro</th>
                    <th>Código</th>
                </tr>   
            </thead>

            <tbody>
                <?php
                    foreach($array_planos as $dado_plano){
                        echo "<tr>";
                        echo "<td style=\"text-align:center\">$dado_plano->nome</td>";
                        echo "<td style=\"text-align:right\">$dado_plano->registro</td>";
                        echo "<td style=\"text-align:right\">$dado_plano->codigo</td>";
                        echo "<tr>";

                        // Realizar append do plano no array planos disponíveis:
                        $_SESSION['planos_disponiveis'][] = $dado_plano->nome;
                    }
                ?>
            </tbody>
        </table>
    </div>

    <hr>

        <h3> Dados de pré-cadastro </h3>

        <form action="processar_infos_cruciais.php" method="post">
            <fieldset>
                <legend>Informações básicas/cruciais</legend>

                <?php
                    if($_SESSION['qtd_beneficiarios_error'] != null){
                        echo "<label><span class=\"msg-aviso\">Erro: número mínimo de beneficiarios não atingido</span></label>";
                    }
                ?>
                <label for="qtd_beneficiarios">Quantidade de Beneficiarios</label>
                <input type="number" name="qtd_beneficiarios" min='0' step="1" value=1>
                <?php // Coloquei min='0' para testar uma implementação ?>

                <?php 
                    if($_SESSION['nome_plano_error'] != null){
                        echo "<label><span class=\"msg-aviso\">Plano inexistente, insira um valor válido conforme a tabela acima</span></label>";
                    }
                ?>
                <label for="nome_plano">Nome do Plano</label>
                <input type="text" name="nome_plano" placeholder="Insira aqui o nome do plano escolhido" required>
                <?php 
                    $_SESSION['nome_plano_error'] = null; 
                    $_SESSION['qtd_beneficiarios_error'] = null;
                ?>

            </fieldset>

            <button type="submit" class="btn-enviar" name="btn-enviar-dados-cruciais">Enviar informações</button>
            <div style="clear:both"></div>
        </form>
    
    </div><?php //fim div principal ?>
</body>
</html>
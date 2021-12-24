<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Processamento dos Cadastro de Beneficiarios</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
    <div id="principal">

    <h1>Página de Processamento dos Cadastro de Beneficiarios</h1>

    <hr>

    <?php
        $nomes_beneficiarios = $_POST['nomes_beneficiarios'];
        $idades_beneficiarios = $_POST['idades_beneficiarios'];
        $nome_plano_escolhido = $_SESSION['nome_plano_escolhido'];       

        $qtd_beneficiarios = count($nomes_beneficiarios);
        
        //echo "<pre>";
        //print_r($nomes_beneficiarios);
        //print_r($idades_beneficiarios);
        //echo "<hr>";
        //var_dump($_SESSION['numero_vidas']);
        //echo "</pre>";
        //echo "<hr>";

        $numero_vidas = $_SESSION['numero_vidas'];
        $idx_termo_plano = 0; // Será utilizado para armazenar o indice do termo adequado ao plano escolhido.
        $termos_plano = $_SESSION['termos_plano_escolhido'];
        $valores = array(); // Armazenará o valor do plano referente a cada beneficiario.
        $qtd_termos = count($termos_plano);

        // Achar o indice do termo idial para o plano escolhido:
        for($i = 0; $i < $qtd_termos; $i++){
            /*echo "<h2>Dados termo $i: </h2>";
            echo "<pre>";
            var_dump($termos_plano[$i]);
            echo "<pre>";*/

            if($numero_vidas >= $termos_plano[$i]['minimo_vidas']){
                $idx_termo_plano = $i;
            }
        }

        //echo "Indice do termo: ". $idx_termo_plano . "<br>";
        //echo "<hr>";


        echo "<table border='1'>";
            echo "<caption>Dados dos Benefíciarios</caption>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Nome do Beneficiário</th>";
                    echo "<th>Idade</th>";
                    echo "<th>Faixa</th>";
                    echo "<th>Valor</th>";
                echo "</tr>";
            echo "<thead>";

            echo "<tbody>";
                for($i = 0; $i < $qtd_beneficiarios; $i++){

                    echo "<tr>";
                    echo "<td>$nomes_beneficiarios[$i]</td>";
                    echo "<td style='text-align:center'>". $idades_beneficiarios[$i] . "</td>";

                    $idade_beneficiario = (int) $idades_beneficiarios[$i];

                    if($idade_beneficiario > 40){
                        $faixa_plano = 3;
                        $valor = $termos_plano[$idx_termo_plano]['faixa3'];
                        $valores[] = $valor;

                    }else if($idade_beneficiario > 17){
                        $faixa_plano = 2;
                        $valor = $termos_plano[$idx_termo_plano]['faixa2'];
                        $valores[] = $valor;

                    }else if($idade_beneficiario >= 0){
                        $faixa_plano = 1;
                        $valor = $termos_plano[$idx_termo_plano]['faixa1'];
                        $valores[] = $valor;

                    }else{
                        $faixa_plano = "Faixa inválida";
                    }
                    echo "<td style='text-align:center;'>$faixa_plano</td>";
                    echo "<td style='text-align:center'>R\$ $valor</td>";
                    echo "</tr>";
                }
            echo "</tbody>";

            echo "<tfoot>";
                echo "<tr>";
                    echo "<td colspan='3' style='text-align:center; font-weight:bold'>Total</td>";
                    echo "<td style='text-align:center;'>R$ ". array_sum($valores) . "</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td colspan='4'><strong>Plano Escolhido:</strong><em><b> <span style='color:blue;'>$nome_plano_escolhido</span></b><em></td>";
                echo "</tr>";
            echo "</tfoot>";

        echo "</table>";

        // Criar variaveis globais com SESSION para pegar dados em outra página:
        $_SESSION['array_valores'] = $valores;
        $_SESSION['array_idades'] = $idades_beneficiarios;
        $_SESSION['array_nomes_beneficiarios'] = $nomes_beneficiarios;

    ?>

    <hr>

    <div>
    <a href="processar_registros.php" class='btn-confirmar'>Confirmar</a>
    <a href="cadastrar_beneficiarios.php" class='btn-voltar'>Voltar</a>
    </div>
    <div style="clear:both"></div>
   
    </div><?php //fim div principal ?>
</body>
</html>
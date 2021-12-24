<?php
    session_start();

    //Dados na global $_SESSION:
    /*echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";*/

    $path = "../data/json/contratos/contratos.json";
    $dados_contrato = array();

    // Obter valores inseridos em outras páginas:
    $nome_plano_escolhido =  $_SESSION['nome_plano_escolhido'];
    $qtd_beneficiarios = $_SESSION['numero_vidas'];
    
    $nomes_beneficiarios  =  $_SESSION['array_nomes_beneficiarios'];
    $idades_beneficiarios =  $_SESSION['array_idades'];
    $array_valores = $_SESSION['array_valores'];
    $valor_total = array_sum($array_valores);
    
    // Inserir dados no array $dados_contrato:
    $dados_contrato['nome_plano'] = $nome_plano_escolhido;
    $dados_contrato['codigo_plano'] = $_SESSION['codigo_plano_escolhido'];
    $dados_contrato['qtd_beneficiarios'] = $qtd_beneficiarios;
    $dados_contrato['valor_total'] = $valor_total;

    // Preencher o array dados_contrato com array contendo informações de cada beneficiário:
    for($i = 0; $i < $qtd_beneficiarios; $i++){

        $dados_contrato['idx_'.$i] = array(

            'nome' => $nomes_beneficiarios[$i],
            'idade' => (int) $idades_beneficiarios[$i],
            'valor' => $array_valores[$i]
        );
    }
    
    // Converter o array no padrão JSON:
    $dados = json_encode($dados_contrato);

    // Mostrar os dados que existem no objeto JSON:
    /*echo "<pre>";
    print_r($dados);
    echo "</pre>";*/

    // Inserindo as informações no arquivo JSON:
    $handle_file = fopen($path, 'w');

    fwrite($handle_file, $dados);

    fclose($handle_file);

    $_SESSION['status_cadastro_anterior'] = 'Sucesso no cadastro';
    
    // Redirecionamento para a página principal:
    header("location: ../index.php");

?>
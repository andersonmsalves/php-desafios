<?php
    session_start();

    /*echo "<pre>";
    print_r($_POST);
    echo "</pre>";*/

    //die();

    $nome_plano = $_POST['nome_plano'];
    $planos_disponiveis = $_SESSION['planos_disponiveis'];
    $qtd_beneficiarios = (int) $_POST['qtd_beneficiarios'];

    // Implementação 23/12/2021:
    $dados_planos = $_SESSION['array_planos']; // Necessário para não ter de ler novamente o JSON;
    $dados_precos = $_SESSION['array_precos']; // Necessário para não ter de ler novamente o JSON;

    if(!in_array($nome_plano, $planos_disponiveis)){

        $_SESSION['nome_plano_error'] = 1;
        header("location: infos_planos.php");
    
    }else{

        /* 
        *Implementação: 23/12/2021
        ->Se o plano escolhido esta no array de planos disponiveis. Então, deve-se verificar se o número de vidas 
        digitado é coberto pelo plano escolhido.
        */
        
        $termos_plano = array(); // Armazenar os diferentes termos que um mesmo plano pode possuir.
        $opcao_plano = 0; // Para ser indice das diferentes opções de um mesmo plano.

        echo "<hr>";
        echo "<h3> Dados do Plano: <span style='font-weight: bold; font-style: italic; color:blue;'>$nome_plano</span></h3>";
        foreach($dados_planos as $dado_plano){
            
            if($nome_plano == $dado_plano->nome){
                $codigo_plano_escolhido = $dado_plano->codigo;
            }
        }

        $_SESSION['codigo_plano_escolhido'] = $codigo_plano_escolhido; //23/12/2021.

        foreach($dados_precos as $dados_preco_opcao){

            if($codigo_plano_escolhido == $dados_preco_opcao->codigo){

                echo "<hr>";
                echo "<h4>Condições para a ". ($opcao_plano + 1) ."ª Opção:</h4>";
                echo "<pre>";
                print_r($dados_preco_opcao);
                
                $termos_plano[$opcao_plano] = [

                    'minimo_vidas' => $dados_preco_opcao->minimo_vidas,
                    'faixa1' => $dados_preco_opcao->faixa1,
                    'faixa2' => $dados_preco_opcao->faixa2,
                    'faixa3' => $dados_preco_opcao->faixa3
                ];

                echo "<h3>Termos:</h3>";
                print_r($termos_plano[$opcao_plano]);

                echo "</pre>";
                $opcao_plano++;
                echo "</hr>";

            }
        }

        $atende_condicao = false;
        $num_opcoes = count($termos_plano);
        
        for($i = 0; $i < $num_opcoes; $i++){

            echo "Numero de beneficiarios digitados: ". var_dump($qtd_beneficiarios) . "<br>";
            echo "Numero mínimo de vidas no termo $i: ". var_dump($termos_plano[$i]['minimo_vidas']) . "<br>";

            if($qtd_beneficiarios >= $termos_plano[$i]['minimo_vidas']){

                $atende_condicao = true;
            }
        }

        if(!$atende_condicao){
            $_SESSION['qtd_beneficiarios_error'] = 1;
            header("location: infos_planos.php");
        }else{
            /*
            ->A instrução abaixo tem que ficar dentro do else porque o PHP carrega muito rapido.
            ->Nesse sentido, a instrução abaixo fora do bloco seria carregada independemente da condição aterior.
            */
            header("location: cadastrar_beneficiarios.php");
        }

        $_SESSION['termos_plano_escolhido'] = $termos_plano;

        /*echo "<hr>";
        echo "<h3> Termos do plano escolhido </h3>";
        echo "<pre>";
        print_r($_SESSION['termos_plano_escolhido']);
        echo "</pre>";
        echo "</hr>";*/

        //die();
        //Fim da implementação.        
    }

    $_SESSION['nome_plano_escolhido'] = $nome_plano;
    $_SESSION['numero_vidas'] = (int) $_POST['qtd_beneficiarios'];

?>

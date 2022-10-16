<?php
    //  ARQUIVO A SER USADO
    $arquivoJSON = "registros.json";

    //  #############################################
    //  DECODE JSON => PHP
    $dadosJson = file_get_contents($arquivoJSON);
    $dadosJsonDecodificados = json_decode($dadosJson);

    //  MOSTRA OS DADOS LIDOS DECODIFICADOS COMO ARRAY
    print_r($dadosJsonDecodificados);

    //  MOSTRA O LAST ERROR (VERIFICA SE LEU O ARQUIVO CORRETAMENTE)
    print_r(json_last_error_msg());

    //  LISTA AS EMPRESAS
    foreach($dadosJsonDecodificados->empresa as $empresa){
        echo 'Nome da empresa: ' . $empresa->nome . PHP_EOL;
    }

    //  LISTA OS CONTATOS (nome e sobrenome)
    foreach($empresa->contatos as $contato){
        echo 'Nome do contato: ' . $contato->nome . ' ' . $contato->sobrenome . PHP_EOL;
    }

    //  #############################################
    //  CASO QUEIRA TRABALHAR COMO OBJETO E NÃO ARRAY
    $dadosJsonDecodificadosObjeto = json_decode($dadosJson, true);

    //  LISTA AS EMPRESAS COMO OBJETO
    foreach($dadosJsonDecodificadosObjeto['empresa'] as $empresa){
        echo 'Nome da empresa: ' . $empresa['nome'] . PHP_EOL;
    }


    //  #############################################
    //  ENCODE PHP => JSON

    //  CRIANDO A ARRAY PARA O JSON
    $arrayEmpresa = Array('empresa' => Array (
            Array(
            'nome' => 'Empresa de garagem',
            'contatos' => Array (
                Array(
                    'nome' => 'Fernando',
                    'sobrenome' => 'Sieiro',
                    'datanasc' => '20-04-1962',
                    'telefone' => "21 2222-7777",
                    'celular' => "21 99999-8888",
                    'email' => "fernando@teste.com"
                ),
                Array(
                    'nome' => 'Wesley',
                    'sobrenome' => 'Takatsu',
                    'datanasc' => '17-02-1990',
                    'telefone' => "21 99316-0875",
                    'celular' => "21 99316-0875",
                    'email' => "wesleytakatsu2@gmail.com"
                ),
                Array(
                    'nome' => 'Valeska',
                    'sobrenome' => 'Alyne',
                    'datanasc' => '27-02-1990',
                    'telefone' => "21 99316-0875",
                    'celular' => "21 99316-0875",
                    'email' => "valeskaalyne@hotmail.com"
                )
            )
        )
    ));

    //  CODIFICANDO PARA JSON
    $dadosJsonCodificados = json_encode($arrayEmpresa, JSON_PRETTY_PRINT);

    print_r($dadosJsonCodificados);

    $fp = fopen($arquivoJSON, 'w');
    fwrite($fp, $dadosJsonCodificados);
    fclose($fp);


    //  #############################################
    //  CRIAR CONTATO
    $empresa['contatos'][] = Array(
        'nome' => 'José',
        'sobrenome' => 'Silva',
        'datanasc' => '11-11-1111',
        'telefone' => "21 77777-5555",
        'celular' => "21 99316-0875",
        'email' => "josesilva@hotmail.com"
    );
    print_r("Lista empresa contatos adicionado:");
    print_r($empresa);

    //  CRIAR EMPRESA
    $empresa[] = [
        'nome' => 'Micro Programas',
        'contatos' => []
    ];
    print_r("Lista empresa contatos adicionado:");
    print_r($empresa);

    print_r("Registro adicionado:");
    print_r($arrayEmpresa);

?>
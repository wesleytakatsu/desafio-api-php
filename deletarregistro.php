<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Desafio API-PHP</title>
</head>
<body>
    <?php
        echo "<pre>";
        include('api_registro.php');
        echo "</pre>";
    ?>
    <header>
        <h1>Desafio API em PHP</h1>
        <h2>Editar Registros</h2>
        <nav>
            <a href='index.php'>Home</a><br>
        </nav>
    </header>
    <main>
        <div class='flexbox-container'>
            <div id='dados-php'>
                <h2>PHP LOG</h2>
                <?php
                    echo "<pre>";
                    include('api_registro_testes.php');
                    $empresa->listaContatos();
                    echo "</pre>";
                ?>
            </div>
            <div id='formulario'>
                <h2>Deletando o Registro</h2>
                <pre>
                <?php

                    echo "Nome recebido no POST: ".$_GET['nomeEmpresa']."<br>";
                    echo "Início do processo de deleção.<br>";


                    //  EXECUTA A DELEÇÃO DA EMPRESA SELECIONADA
                    if(isset($_GET['nomeEmpresa']) && isset($_GET['deletarEmpresa'])){
                        $empresa->deletaEmpresa($_GET['nomeEmpresa']);
                    }

                    //  EXECUTA A DELEÇÃO DO CONTATO SELECIONADO
                    if(isset($_GET['nomeEmpresa']) && isset($_GET['nomeContato'])){
                        $empresa->deletaContato($_GET['nomeEmpresa'], $_GET['nomeContato']);
                    }
                ?>
                </pre>
            </div>
        </div>
    </main>
</body>
</html>




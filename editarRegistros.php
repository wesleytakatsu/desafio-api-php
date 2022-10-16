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
                <h2>Deletar ou Editar Registro</h2>
                <?php
                    foreach($empresa->dadosJsonDecodificados['empresa'] as $empresa){
                        echo "<br>Empresa: " . $empresa['nome'] .
                            " <a href='deletar.php?empresa=".$empresa['nome']."'>Deletar</a> ".
                            " <a href='editar.php?empresa=".$empresa['nome']."'>Editar</a> ".
                            "<br>";
                        foreach($empresa['contatos'] as $contato){
                            echo "Contato: " . $contato['nome'] . " " . $contato['sobrenome'] . 
                            " <a href='deletar.php?contato=".$contato['nome'].$contato['sobrenome']."'>Deletar</a> ".
                            " <a href='editar.php?contato=".$contato['nome'].$contato['sobrenome']."'>Editar</a> ".
                            "<br>";
                        }
                    }

                ?>

            </div>
        </div>


    </main>



</body>
</html>
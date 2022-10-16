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
        <h2>Formulário de Registro de Empresa</h2>
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
                <h2>Adicionar contato</h2>
                <form action="formEmpresa.php" method="post">
                    <label for="nomeEmpresa">Nome da empresa:</label><br>
                    <input type="text" id="nomeEmpresa" name="nomeEmpresa" placeholder="Digite seu nome">
                    <input type="submit" value="Registrar Empresa">
                </form>
            </div>
        </div>


    </main>



</body>
</html>
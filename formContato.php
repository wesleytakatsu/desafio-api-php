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
        <h2>Formulário de Registro de Contato</h2>
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
                <form action="formContato.php" method="post">


                    <label for="empresa">Empresa:</label><br>

                    <select name="empresa" id="empresa">
                    <?php
                    foreach($empresa->getEmpresas() as $empresas){
                        echo "<option value='" . $empresas['nome'] ."'>".$empresas['nome']."</option>";
                    }
                    ?>
                    </select><br>
                    <label for="nome">Nome:</label><br>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome"><br>
                    <label for="sobrenome">Sobrenome:</label><br>
                    <input type="text" id="sobrenome" name="sobrenome" placeholder="Digite seu sobrenomenome"><br>
                    <label for="datanasc">Data de Nascimento:</label><br>
                    <input type="date" id="datanasc" name="datanasc" placeholder="Digite sua data de nascimento"><br>
                    <label for="telefone">Telefone:</label><br>
                    <input type="text" id="telefone" name="telefone" placeholder="(xx) xxxx-xxxx"><br>
                    <label for="celular">Celular:</label><br>
                    <input type="text" id="celular" name="celular" placeholder="(xx) xxxxx-xxxx"><br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail"><br><br>
                    <input type="submit" value="Registrar Contato">
                </form>
            </div>
        </div>


    </main>



</body>
</html>
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
        <nav>
            <h2>Formulários:<br>
                <a href="formEmpresa.php">Cadastro de Empresas</a><br>
                <a href="formContato.php">Cadastro de Contato</a><br>
                <a href="editarRegistros.php">Editar Registros</a><br>
            </h2>
            <a href='index.php'>Home</a><br>
            <a href='index.php?versaoPHP=true'>Versão do PHP</a><br>
            <br>
            <div class='flexbox-container'>
                <div id='metodos'>
                    <strong>Médotos implementados na API:</strong><br>
                    getEmpresas() => retorna uma Array com as empresas.<br>
                    getContatos(nome da empresa) => retorna uma Array com os contatos da empresa<br>
                    carregarArquivo(nome do arquivo) => carrega arquivo JSON<br>
                    gravarArquivo() => salva a Array $dadosJsonCodificados no arquivo JSON aberto<br>
                    <br>
                    contatoAdicionar($empresaNome, $contatoArray) => Salva contato na empresa passada no parâmetro<br>
                    <br>
                    <strong>Médotos em implementação na API:</strong><br>
                    contatoAtualizar($empresaNome, $clienteNome) => modifica um contato espefícico de uma empresa<br>
                </div>
                <div id='execucao'>
                    <a href='index.php?listaContatos=true'>listaContatos()</a> => Clique para executar<br>
                    <a href='index.php?listaEmpresas=true'>listaEmpresas()</a> => Clique para executar<br>
                    <br>
                    <strong>Médotos implementados na Classe de testes:</strong><br>
                    <a href='index.php?mostrarDados=true'>mostrarDados()</a> => Clique para executar<br>
                    <a href='index.php?mostrarBanco=true'>mostrarBanco()</a> => Clique para executar<br>
                </div>
            </div>
            

        </nav>
    </header>
    <main>
        <div class='flexbox-container'>
            <div id='dados-php'>
                <h2>PHP LOG</h2>
                <?php
                    echo "<pre>";
                    include('api_registro_testes.php');
                    echo "</pre>";
                ?>
            </div>
            <div id='formulario'>
                <pre>
                    <?php
                        $empresa->listaContatos();
                    ?>
                </pre>
            </div>
        </div>


    </main>



</body>
</html>
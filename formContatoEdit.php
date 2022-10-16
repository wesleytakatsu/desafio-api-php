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
                <h2>Alterar contato</h2>
                <?php
                    //  EXECUTA A ALTERAÇÃO
                    if(isset($_POST['nome']) && $_POST['sobrenome']){
                        echo "Post OK";
                        $contatoArray = [
                            "nome"=> $_POST['nome'],
                            "sobrenome"=> $_POST['sobrenome'],
                            "nomesobrenome"=> $_POST['nome']." ".$_POST['sobrenome'],
                            "datanasc"=> $_POST['datanasc'],
                            "telefone"=> $_POST['telefone'],
                            "celular"=> $_POST['celular'],
                            "email"=> $_POST['email']
                        ];
                        //  contatoAtualizar ( CHAVE EMPRESA , ARRAY CONTATO , CHAVE CONTATO)
                        $empresa->contatoAtualizar($_POST['idempresa'], $contatoArray, $_POST['idcontato']);

                    }else{
                        //  VERIRICA SE RECEBEU OS PARÂMETROS E PEGA O CLIENTE ESPECIFICADO
                        if( isset($_GET['nomeEmpresa']) && isset($_GET['nomeContato'])){
                            $contato = $empresa->getContatoEmpresa($_GET['nomeEmpresa'], $_GET['nomeContato']);
                        
                        
                        //  PREENCHE O FORMULÁRIO COM OS DADOS RETORNADOS
                        echo "<form action='formContatoEdit.php' method='post'>";

                        echo "<label for='empresa'>Empresa:</label><br>";
                        echo "<input type='text' id='empresa' name='empresa' value='".$_GET['nomeEmpresa']."' readonly><br>";

                        echo "<label for='idempresa'>ID Empresa:</label><br>";
                        echo "<input type='text' id='idempresa' name='idempresa' value='".$empresa->chaveEmpresa."' readonly><br>";

                        echo "<label for='idcontato'>ID Contato:</label><br>";
                        echo "<input type='text' id='idcontato' name='idcontato' value='".$empresa->chaveContato."' readonly><br>";

                        echo "<label for='nome'>Nome:</label><br>";
                        echo "<input type='text' id='nome' name='nome' value='".$contato['nome']."' ><br>";

                        echo "<label for='sobrenome'>Sobrenome:</label><br>";
                        echo "<input type='text' id='sobrenome' name='sobrenome' value='".$contato['sobrenome']."' ><br>";

                        echo "<label for='datanasc'>Data de Nascimento:</label><br>";
                        echo "<input type='date' id='datanasc' name='datanasc' value='".$contato['datanasc']."' ><br>";

                        echo "<label for='telefone'>Telefone:</label><br>";
                        echo "<input type='text' id='telefone' name='telefone' value='".$contato['telefone']."' ><br>";

                        echo "<label for='celular'>Celular:</label><br>";
                        echo "<input type='text' id='celular' name='celular' value='".$contato['celular']."' ><br>";

                        echo "<label for='email'>Email:</label><br>";
                        echo "<input type='email' id='email' name='email' value='".$contato['email']."' ><br><br>";

                        echo "<input type='submit' value='Alterar Contato'>";
                        }else{
                            echo "Parâmetros incompletos pela URL!";
                        }
                    }
                ?>
                </form>
            </div>
        </div>


    </main>



</body>
</html>
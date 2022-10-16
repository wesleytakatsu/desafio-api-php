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
                    if(isset($_POST['nomeEmpresa']) && $_POST['atualizaEmpresa']){
                        $nomeEmpresa = $_POST['nomeEmpresa'];
                        $chaveEmpresa = $_POST['chaveEmpresa'];
                        echo "Post OK";

                        //  empresaAtualizar ( CHAVE EMPRESA , NOME EMPRESA)
                        $empresa->empresaAtualizar($chaveEmpresa, $nomeEmpresa);

                    }else{
                        //  VERIRICA SE RECEBEU OS PARÂMETROS E PEGA O CLIENTE ESPECIFICADO
                        if( isset($_GET['nomeEmpresa']) && isset($_GET['atualizaEmpresa'])){
                            $nomeEmpresa = $_GET['nomeEmpresa'];
                            $chaveEmpresa = $empresa->getChaveEmpresa($nomeEmpresa);
                            
                        
                        //  PREENCHE O FORMULÁRIO COM OS DADOS RETORNADOS
                        echo "<form action='formEmpresaEdit.php' method='post'>";

                        echo "
                                <input type='checkbox' id='atualizaEmpresa' name='atualizaEmpresa' checked onclick='return false;'>
                            ";

                        echo "<label for='chaveEmpresa'>Chave da empresa:</label><br>";
                        echo "<input type='text' size='3' id='chaveEmpresa' name='chaveEmpresa' value='".
                            $chaveEmpresa
                            ."' readonly><br><br>";

                        echo "<label for='nomeEmpresa'>Nome da empresa:</label><br>";
                        echo "<input type='text' id='nomeEmpresa' name='nomeEmpresa' value='".
                            $nomeEmpresa
                            ."'>";
                        echo "<input type='submit' value='Alterar Empresa'>";

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
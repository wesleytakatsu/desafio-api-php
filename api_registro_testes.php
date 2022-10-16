<?php
    //  HERDA A CLASSE PRINCIPAL E USA O CONSTRUTOR DELA
    class EmpresaExemplo extends Empresa {
        function __construct($arquivoJSON) {
            parent::__construct($arquivoJSON);
        }
        
        //  OBSOLETO (USADO PARA AUTOMATIZAR OS TESTES)
        function carregaArrayExemplo(){
            //  CRIANDO A ARRAY PARA O JSON
            $this->dadosJsonDecodificados = Array('empresa' => Array (
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
        }

        //  MOSTRA OS VALORES DE TODAS AS VARIÁVEIS DO OBJETO
        function mostrarDados(){
            print_r("<br>dadosJsonDecodificados: ");
            print_r($this->dadosJsonDecodificados);
            print_r("dadosJsonDecodificadosObjeto: ");
            print_r($this->dadosJsonDecodificadosObjeto);
            print_r("contatos: ");
            print_r($this->contatos);
            print_r("empresas: ");
            print_r($this->empresas);
            print_r("arquivoJSON: ");
            print_r($this->arquivoJSON);

        }

        function mostrarBanco(){
            print_r("arquivoJSON: ");
            print_r($this->arquivoJSON);
            print_r("<br>dadosJsonDecodificados: ");
            print_r($this->dadosJsonDecodificados);
        }

        //  OBSOLETO
        function criarContatoExemplo(){
            //  CRIAR CONTATO
            $this->empresas['contatos'][] = Array(
                'nome' => 'José',
                'sobrenome' => 'Silva',
                'datanasc' => '11-11-1111',
                'telefone' => "21 77777-5555",
                'celular' => "21 99316-0875",
                'email' => "josesilva@hotmail.com"
            );
            print_r("Lista empresa contatos adicionado:");
            print_r($this->empresas);
        }

        //  OBSOLETO
        function teste(){
            print_r(
                array_search(
                    'Empresa de garagem',
                    array_column(
                        $this->dadosJsonDecodificados['empresa'], 'nome'
                    )
                )
            );
        }
    }

    //  INSTANCIANDO E ESCOLHENDO O ARQUIVO A SER USADO
    $empresa = new EmpresaExemplo("registros.json");
    echo "<br>";

    // OPÇÕES DA PÁGINA PRINCIPAL CHAMANDO OS MÉTODOS
    if (isset($_GET['mostrarDados'])) {
        $empresa->mostrarDados();
    }
    if (isset($_GET['versaoPHP'])) {
        phpinfo();
    }
    if (isset($_GET['listaContatos'])) {
        $empresa->listaContatos();
    }
    if (isset($_GET['listaEmpresas'])) {
        $empresa->listaEmpresas();
    }
    if (isset($_GET['mostrarBanco'])) {
        $empresa->mostrarBanco();
    }
    
    
    //  VALIDAÇÃO DE FORMULÁRIOS (PASSAR PARA A API)
    //  REGISTRO CONTATOS
    if(isset($_POST['nome']) && $_POST['sobrenome'] && isset($_POST['adicionaContato'])){
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

        $empresa->contatoAdicionar($_POST['empresa'], $contatoArray);
        //$empresa->listaContatos();
    }

    // REGISTRO EMPRESAS
    if(isset($_POST['nomeEmpresa']) && isset($_POST['adicionaEmpresa'])){
        echo "<br>Post OK<br>";
        print_r($_POST['nomeEmpresa']);
        $empresa->empresaAdicionar($_POST['nomeEmpresa']);
        $empresa->listaContatos();
    }


    //$empresa->contatoSelecionar();




?>
<?php

    class Empresa {
        // Propriedades
        public $contatos; // ARRAY CONTATOS
        public $empresas; // ARRAY EMPRESAS
        public $chaveEmpresa;   //ATRIBUTO TEMPORÁRIO
        public $chaveContato;   //ATRIBUTO TEMPORÁRIO
        public $arquivoJSON; //NOME ARQUIVO
        public $dadosJsonDecodificados; //ARRAY
        public $dadosJsonDecodificadosObjeto; //OBJETO

        // FINALIZADO
        // CONSTRUTOR INICIA COM O NOME DO ARQ JSON
        function __construct($arquivoJSON){
            $this->arquivoJSON = $arquivoJSON;
            //  DECODE JSON => PHP
            $dadosJson = file_get_contents($arquivoJSON);
            $this->dadosJsonDecodificados = json_decode($dadosJson, true);

            //  CASO QUEIRA TRABALHAR COMO OBJETO E NÃO ARRAY
            $this->dadosJsonDecodificadosObjeto = json_decode($dadosJson);

            //  CARREGA AS EMPRESAS
            $this->empresas = $this->dadosJsonDecodificados;

            //  MOSTRA O LAST ERROR (VERIFICA SE LEU O ARQUIVO CORRETAMENTE)
            echo "Construtor: ";
            print_r(json_last_error_msg());
        }
        // FINALIZADO
        function getEmpresas(){
            return $this->dadosJsonDecodificados['empresa'];
        }
        // FINALIZADO
        function getContatos($nomeEmpresa){
            foreach ($this->dadosJsonDecodificados['empresa'] as $empresa){
                if( $empresa['nome'] == $nomeEmpresa){
                    return $empresa['contatos'];
                }
            }
            return null;
        }
        function getContatoEmpresa($nomeEmpresa, $nomeContato){
            //  RETORNA UM CONTATO ESPECÍFICO DE UMA EMPRESA ESPECÍFICA
            echo "<br>Executou getContatoEmpresa<br>";
            echo "Nome Empresa: ".$nomeEmpresa."<br>";
            echo "Nome Contato: ".$nomeContato."<br>";
            $this->chaveEmpresa = array_search(
                $nomeEmpresa,
                array_column(
                    $this->dadosJsonDecodificados['empresa'], 'nome'
                )
            );
            echo "Chave empresa: ".$this->chaveEmpresa."<br>";
            $this->chaveContato = array_search(
                $nomeContato,
                array_column(
                    $this->dadosJsonDecodificados['empresa'][$this->chaveEmpresa]['contatos'], 'nomesobrenome'
                )
            );
            echo "Chave Contato: ".$this->chaveContato."<br>";
            return $this->dadosJsonDecodificados['empresa'][$this->chaveEmpresa]['contatos'][$this->chaveContato];
        }
        function getChaveEmpresa($nomeEmpresa){
            $this->chaveEmpresa = array_search(
                $nomeEmpresa,
                array_column(
                    $this->dadosJsonDecodificados['empresa'], 'nome'
                )
            );
            return $this->chaveEmpresa;
        }
        // FINALIZADO
        function carregarArquivo($arquivoJSON){
            $this->arquivoJSON = "registros.json";
            
            //  DECODE JSON => PHP
            $dadosJson = file_get_contents($arquivoJSON);
            $this->dadosJsonDecodificados = json_decode($dadosJson, true);

            //  MOSTRA O LAST ERROR (VERIFICA SE LEU O ARQUIVO CORRETAMENTE)
            print_r(json_last_error_msg());

            //  CASO QUEIRA TRABALHAR COMO OBJETO E NÃO ARRAY
            $this->dadosJsonDecodificadosObjeto = json_decode($dadosJson);

        }

        // FINALIZADO
        function gravarArquivo(){
            //  CODIFICANDO PARA JSON E GRAVANDO NO ARQUIVO
            $this->dadosJsonCodificados = json_encode($this->dadosJsonDecodificados, JSON_PRETTY_PRINT);

            $fp = fopen($this->arquivoJSON, 'w');
            fwrite($fp, $this->dadosJsonCodificados);
            fclose($fp);
        }

        // FINALIZADO
        function contatoAdicionar($empresaNome, $contatoArray){

            $contatoValidado = true;
            if ($this->validarData($contatoArray['datanasc'])){
                echo "<br>data nascimento válida!<br>";
            }else{
                echo "<br>data nascimento inválida!<br>";
                $contatoValidado = false;
            }
    
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo "<br>email válido!<br>";
            }
            else {
                echo "email inválido!<br>";
                $contatoValidado = false;
            }
            echo "<br>Registro a ser inserido:<br>";
            print_r($contatoArray);
    

            //  BUSCA PELA EMPRESA QUE O CONTATO SERÁ REGISTRADO
            $chave = array_search(
                $empresaNome,
                array_column(
                    $this->dadosJsonDecodificados['empresa'], 'nome'
                )
            );
            
            //  BUSCA PARA VER SE O CONTATO JÁ EXISTE
            echo "<br>Estrutura de contatos da empresa selecionada: ".$empresaNome."<br>";
            print_r( $this->dadosJsonDecodificados['empresa'][$chave]['contatos']);
            $chaveContato = array_search(
                $contatoArray['nomesobrenome'],
                array_column(
                    $this->dadosJsonDecodificados['empresa'][$chave]['contatos'],
                    'nomesobrenome'
                )
            );
            echo "<br>Buscando contatos na lista pelo nome: ".$contatoArray['nomesobrenome'];
            echo "<br>retorno da chave: ".$chaveContato."<br>";
            echo "<br>Retorno do array_column:<br>";
            print_r(
                array_column(
                    $this->dadosJsonDecodificados['empresa'][$chave]['contatos'],
                    'nomesobrenome'
                )
            );
            
            if( $chaveContato == null && $chaveContato !== 0){
                echo "<br>Registrado com sucesso!<br>";
                array_push(
                    $this->dadosJsonDecodificados['empresa'][$chave]['contatos'],
                    $contatoArray
                );
            }else{
                echo "<br>registro encontrado: ".$chaveContato."<br>";
                echo "<br>O nome do contato já existe!<br>";
            }

            //echo "ARRAY DEPOIS:<br>";
            //print_r($this->dadosJsonDecodificados['empresa'][$chave]['contatos']);

            $this->gravarArquivo();
        }

        // FINALIZADO
        function empresaAdicionar($empresaNome){
            $chave = array_search(
                $empresaNome,
                array_column(
                    $this->dadosJsonDecodificados['empresa'], 'nome'
                )
            );
            if($chave == null){
                echo "ARRAY ANTES:<br>";
                print_r($this->dadosJsonDecodificados['empresa']);

                array_push(
                    $this->dadosJsonDecodificados['empresa'],
                    Array(
                        'nome' => $empresaNome,
                        'contatos' => []
                    )
                );
                echo "ARRAY DEPOIS:<br>";
                print_r($this->dadosJsonDecodificados['empresa']);

                $this->gravarArquivo();
            }else{
                echo "<br>O nome da empresa já existe!";
            }
        }

        // FINALIZADO
        function contatoAtualizar($chaveEmpresa, $contatoArray, $chaveContato){
            echo "<br>Executando a alteração!<br>";

            //  RETORNA UM CONTATO ESPECÍFICO DE UMA EMPRESA ESPECÍFICA
            echo "<br>Executou contatoAtualizar<br>";
            echo "Nome Empresa: ".$this->dadosJsonDecodificados['empresa'][$chaveEmpresa]['nome']."<br>";
            echo "Nome Contato: ".$contatoArray['nomesobrenome']."<br>";
            
            echo "Chave empresa: ".$chaveEmpresa."<br>";
            echo "Chave Contato: ".$chaveContato."<br>";

            $base = $this->dadosJsonDecodificados['empresa'][$chaveEmpresa]['contatos'];
            $replacement = array( $chaveContato => $contatoArray );
            $overwrited = array_replace($base, $replacement);
            echo "<pre>";
            print_r($overwrited);
            $this->dadosJsonDecodificados['empresa'][$chaveEmpresa]['contatos'] = $overwrited;
            echo "Resultado do merge";
            print_r($this->dadosJsonDecodificados['empresa'][$chaveEmpresa]['contatos']);
            echo "</pre>";

            $this->gravarArquivo();
        }

        // FINALIZADO
        function empresaAtualizar($chaveEmpresa, $nomeEmpresa){
            echo "<br>Executando a alteração!<br>";

            //  RETORNA UM CONTATO ESPECÍFICO DE UMA EMPRESA ESPECÍFICA
            echo "<br>Executou empresaAtualizar<br>";

            echo "Chave empresa: ".$chaveEmpresa."<br>";
            echo "Nome Empresa: ".$nomeEmpresa."<br>";

            //  ARMAZENA OS CONTATOS DA EMPRESA
            $contatosEmpresa = $this->dadosJsonDecodificados['empresa'][$chaveEmpresa]['contatos'];

            //  ARRAY EMPRESA PRONTA PARA SUBSTITUIR A ORIGINAL
            $arrayEmpresaAtualizada = array (
                    'nome' => $nomeEmpresa,
                    'contatos' => $contatosEmpresa
            );
            
            //  ARRAY ORIGINAL COMPLETA PARA SER ALTERADA
            $base = $this->dadosJsonDecodificados['empresa'];

            //  PREPARO PARA SUBSTITUIÇÃO
            $replacement = array( $chaveEmpresa => $arrayEmpresaAtualizada );

            //  ALTERAÇÃO DA ARRAY ORIGINAL
            $overwrited = array_replace($base, $replacement);

            //  MOSTRANDO O RESULTADO DA ALTERAÇÃO NA TELA
            echo "<pre>";
            $this->dadosJsonDecodificados['empresa'] = $overwrited;
            echo "Resultado do merge:<br>";
            print_r($this->dadosJsonDecodificados['empresa']);
            echo "</pre>";
            $this->gravarArquivo();
        }
        // FINALIZADO
        function deletaContato($nomeEmpresa, $nomeContato){
            echo "<br>Executou deletaContato()<br>";
            echo "Nome Empresa: ".$nomeEmpresa."<br>";
            echo "Nome Contato: ".$nomeContato."<br>";
            $chaveEmpresa = array_search(
                $nomeEmpresa,
                array_column(
                    $this->dadosJsonDecodificados['empresa'], 'nome'
                )
            );
            echo "Chave empresa: ".$chaveEmpresa."<br>";
            $chaveContato = array_search(
                $nomeContato,
                array_column(
                    $this->dadosJsonDecodificados['empresa'][$chaveEmpresa]['contatos'], 'nomesobrenome'
                )
            );
            echo "Chave Contato: ".$chaveContato."<br>";
            array_splice($this->dadosJsonDecodificados['empresa'][$chaveEmpresa]['contatos'], $chaveContato);
            echo "Resultado da remoção:<br>";
            print_r($this->dadosJsonDecodificados['empresa'][$chaveEmpresa]['contatos']);
            $this->gravarArquivo();
        }

        // FINALIZADO
        function listaEmpresas() {
            foreach($this->dadosJsonDecodificados['empresa'] as $empresas){
                echo '<br>Nome da empresa: ' . $empresas['nome'] . PHP_EOL;
            }
        }

        // VERIFICAR
        function listaEmpresasObj(){
            //  LISTA AS EMPRESAS COMO OBJETO
            foreach($this->dadosJsonDecodificadosObjeto['empresa'] as $empresa){
                echo 'Nome da empresa: ' . $empresa['nome'] . PHP_EOL;
            }
        }

        // FINALIZADO
        function deletaEmpresa($nomeEmpresa){
            $chave = array_search(
                $nomeEmpresa,
                array_column(
                    $this->dadosJsonDecodificados['empresa'], 'nome'
                )
            );
            array_splice($this->dadosJsonDecodificados['empresa'], $chave, 1);
            print_r($this->dadosJsonDecodificados['empresa']);
            $this->gravarArquivo();
        }

        // FINALIZADO
        function listaContatos() {
            //  LISTA OS CONTATOS (nome e sobrenome)
            echo "<br>";
            foreach($this->dadosJsonDecodificados['empresa'] as $empresa){
                echo '<br>Nome da empresa: ' . $empresa['nome'] . PHP_EOL;
                foreach($empresa['contatos'] as $contato){
                    echo 'Nome do contato: ' . $contato['nome'] . ' ' . $contato['sobrenome'] . PHP_EOL;
                }
            }
        }

        //  VERIFICAR
        function contatoSelecionar(){
            print_r( $this->dadosJsonDecodificados['empresa'][0]['nome']  ); 
            print_r($this->dadosJsonDecodificados['empresa']);
        }

        //  FINALIZADO
        //  VALIDAÇÃO DO CAMPO DATA DO FORMULÁRIO
        function validarData($data, $formato = 'Y-m-d'){
            $d = DateTime::createFromFormat($formato, $data);
            // Usa 4 dígitos para o ano. Retorna true se for validado.
            return $d && $d->format($formato) === $data;
        }
    }


?>
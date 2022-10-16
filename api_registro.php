<?php

    class Empresa {
        // Properties
        public $contatos; // ARRAY CONTATOS
        public $empresas; // ARRAY EMPRESAS
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

            //print_r($this->dadosJsonCodificados);

            $fp = fopen($this->arquivoJSON, 'w');
            fwrite($fp, $this->dadosJsonCodificados);
            fclose($fp);
        }

        // FINALIZADO
        function contatoAdicionar($empresaNome, $contatoArray){

            $chave = array_search(
                $empresaNome,
                array_column(
                    $this->dadosJsonDecodificados['empresa'], 'nome'
                )
            );
            //echo "ARRAY ANTES:<br>";
            //print_r($this->dadosJsonDecodificados['empresa'][$chave]['contatos']);

            $nomeSobrenome = $contatoArray['nome'].$contatoArray['sobrenome'];
            $chaveContato = array_search(
                $empresaNome,
                array_column(
                    $this->dadosJsonDecodificados['empresa'][$chave]['contatos'],
                    $nomeSobrenome
                )
            );
            if($chave == null){
                array_push(
                    $this->dadosJsonDecodificados['empresa'][$chave]['contatos'],
                    $contatoArray
                );
            }else{
                echo "<br>O nome do contato já existe!";
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

        // VERIFICAR
        function contatoAtualizar($empresaNome, $clienteNome){

        }

        // VERIFICAR
        function contatoRemover(){

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
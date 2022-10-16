<?php
    //$con = mysqli_connect("localhost", "root", "1231","desafio-api");
    $infocliente = array();

    $sql = "select * from clientes";

    Class Cliente{
        public $nome;
        public $sobrenome;
        public $datanasc;
        public $telefone;
        public $email;

        function get_nome(){
            return $this->nome;
        }

    }

    $novoCliente = new Cliente();

    $novoCliente->nome = "Wesley";

    function escrevenome(){

    }

    echo "teste";

?>
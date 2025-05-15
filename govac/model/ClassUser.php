<?php
    class ClassUser{
        
        private $idusuario;
        private $tipousuario;
        private $senha;
        private $cpf;
        private $nome;
        private $endereco;
        private $email;
        private $telefone;

        // GETTERS

        function getIdusuario(){
            return $this->idusuario;
        }

        function getTipousuario(){
            return $this->tipousuario;
        }

        function getSenha(){
            return $this->senha;
        }

        function getCpf(){
            return $this->cpf;
        }

        function getNome(){
            return $this->nome;
        }

        function getEndereco(){
            return $this->endereco;
        }

        function getEmail(){
            return $this->email;
        }

        function getTelefone(){
            return $this->telefone;
        }


        // SETTERS

        function setIdusuario($idusuario){
            $this->idusuario = $idusuario;
        }

        function setTipousuario($tipousuario){
            $this->tipousuario = $tipousuario;
        }

        function setSenha($senha){
            $this->senha = $senha;
        }

        function setCpf($cpf){
            $this->cpf = $cpf;
        }

        function setNome($nome){
            $this->nome = $nome;
        }

        function setEndereco($endereco){
            $this->endereco = $endereco;
        }
    
        function setEmail($email){
            $this->email = $email;
        }

        function setTelefone($telefone){
            $this->telefone = $telefone;
        }
    }
<?php
    class ClassUser{
        
        private $idusuario;
        private $tipousuario;
        private $email;
        private $senha;
        private $nome;
        private $cpf;
        private $endereco;
        private $telefone;

        // GETTERS

        function getIdusuario(){
            return $this->idusuario;
        }

        function getTipousuario(){
            return $this->tipousuario;
        }
        
        function getEmail(){
            return $this->email;
        }

        function getSenha(){
            return $this->senha;
        }

        function getNome(){
            return $this->nome;
        }

        function getCpf(){
            return $this->cpf;
        }

        function getEndereco(){
            return $this->endereco;
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

        function setEmail($email){
            $this->email = $email;
        }

        function setSenha($senha){
            $this->senha = $senha;
        }
        
        function setNome($nome){
            $this->nome = $nome;
        }

        function setCpf($cpf){
            $this->cpf = $cpf;
        }

        function setEndereco($endereco){
            $this->endereco = $endereco;
        }
    
        function setTelefone($telefone){
            $this->telefone = $telefone;
        }
    }
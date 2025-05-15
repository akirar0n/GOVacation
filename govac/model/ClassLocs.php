<?php

    class ClassLocs{

        private $idloc;
        private $tipoloc;
        private $titulo;
        private $descr;
        private $preco;
        private $localizacao;
        private $qtdhospedes;
        private $disp;

        function getIdloc(){
            return $this->idloc;
        }

        function getTipoloc(){
            return $this->tipoloc;
        }

        function getTitulo(){
            return $this->titulo;
        }

        function getDescr(){
            return $this->descr;
        }

        function getPreco(){
            return $this->preco;
        }

        function getLocalizacao(){
            return $this->localizacao;
        }

        function getQtdhospedes(){
            return $this->qtdhospedes;
        }

        function getDisp(){
            return $this->disp;
        }

        function setIdloc($idloc){
            $this->idloc = $idloc;
        }

        function setTipoloc($tipoloc){
            $this->tipoloc = $tipoloc;
        }

        function setTitulo($titulo){
            $this->titulo = $titulo;
        }

        function setDescr($descr){
            $this->descr = $descr;
        }

        function setPreco($preco){
            $this->preco = $preco;
        }

        function setLocalizacao($localizacao){
            $this->localizacao = $localizacao;
        }

        function setQtdhospedes($qtdhospedes){
            $this->qtdhospedes = $qtdhospedes;
        }

        function setDisp($disp){
            $this->disp = $disp;
        }

    }
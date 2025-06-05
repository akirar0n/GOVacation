<?php
    class ClassRes{
        
        private $idreserva;
        private $idusuario;
        private $idloc;
        private $metodopag;
        private $datacheckin;
        private $datacheckout;

        // GETTERS

        function getIdreserva(){
            return $this->idreserva;
        }

        function getIdusuario(){
            return $this->idusuario;
        }

        function getIdloc(){
            return $this->idloc;
        }

        function getMetodopag(){
            return $this->metodopag;
        }

        function getDatacheckin(){
            return $this->datacheckin;
        }

        function getDatacheckout(){
            return $this->datacheckout;
        }

        // SETTERS

        function setIdreserva($idreserva){
            $this->idreserva = $idreserva;
        }

        function setIdusuario($idusuario){
            $this->idusuario = $idusuario;
        }

        function setIdloc($idloc){
            $this->idloc = $idloc;
        }

        function setMetodopag($metodopag){
            $this->metodopag = $metodopag;
        }
        
        function setDatacheckin($datacheckin){
            $this->datacheckin = $datacheckin;
        }

        function setDatacheckout($datacheckout){
            $this->datacheckout = $datacheckout;
        }
    }
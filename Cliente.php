<?php

class Cliente{

    //ATRIBUTOS
    private $nombre;
    private $apellido;
    private $estado;
    private $tipoDocumento;
    private $numeroDocumento;

    //$estado es un string que vale "alta" para clientes en alta y "baja" para clientes en baja

    //CONSTRUCTOR
    public function __construct($nombre, $apellido, $estado, $tipoDocumento, $numeroDocumento){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->estado = $estado;
        $this->tipoDocumento = $tipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
    }

    //OBSERVADORES
    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }

    public function getNumeroDocumento(){
        return $this->numeroDocumento;
    }

    //MODIFICADORES 
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function setTipoDocumento($tipoDocumento){
        $this->tipoDocumento = $tipoDocumento;
    }

    public function setNumeroDocumento($numeroDocumento){
        $this->numeroDocumento = $numeroDocumento;
    }

    //PROPIOS DE CLASE
    /**
     * Devuelve una cadena con los valores de los atributos de la instancia actual de la clase Cliente
     * 
     * @return string
     */
    public function __toString(){
        //string $cadena
        $cadena = "[Nombre: ".$this->getNombre()."]";
        $cadena = $cadena. "[Apellido: ".$this->getApellido()."]";
        $cadena = $cadena. "[Estado: ".$this->getEstado()."]";
        $cadena = $cadena. "[Tipo documento: ".$this->getTipoDocumento()."]";
        $cadena = $cadena. "[N° de documento: ".$this->getNumeroDocumento()."]";

        return $cadena;
    }
}

?>
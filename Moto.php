<?php

class Moto{

    //ATRIBUTOS
    private $codigo;
    private $costo;
    private $anioFabricacion;
    private $descripcion;
    private $porcIncAnual;
    private $activa;

    //$activa es un booleano que vale true si la moto está activa y false en caso contrario

    //CONSTRUCTOR
    public function __construct($codigo, $costo, $anioFabricacion, $descripcion, $porcIncAnual, $activa){
        $this->codigo = $codigo;
        $this->costo = $costo;
        $this->anioFabricacion = $anioFabricacion;
        $this->descripcion = $descripcion;
        $this->porcIncAnual = $porcIncAnual;
        $this->activa = $activa;
    }

    //OBSERVADORES
    public function getCodigo(){
        return $this->codigo;
    }

    public function getCosto(){
        return $this->costo;
    }

    public function getAnioFabricacion(){
        return $this->anioFabricacion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getPorcIncAnual(){
        return $this->porcIncAnual;
    }

    public function getActiva(){
        return $this->activa;
    }

    //MODIFICADORES
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function setCosto($costo){
        $this->costo = $costo;
    }

    public function setAnioFabricacion($anioFabricacion){
        $this->anioFabricacion = $anioFabricacion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function setPorcIncAnual($porcIncAnual){
        $this->porcIncAnual = $porcIncAnual;
    }

    public function setActiva($activa){
        $this->activa = $activa;
    }

    //PROPIOS DE CLASE
    /**
     * Devuelve una cadena con los valores de los atributos de la instancia actual de la clase Moto
     * 
     * @return string
     */
    public function __toString(){
        //string $cadena
        $estadoActiva = $this->getActiva()? "Si": "No";

        $cadena = "[Código: ".$this->getCodigo()."]";
        $cadena = $cadena. "[Costo: $".$this->getCosto()."]";
        $cadena = $cadena. "[Año de fab.: ".$this->getAnioFabricacion()."]";
        $cadena = $cadena. "[Descripcion: ".$this->getDescripcion()."]\n";
        $cadena = $cadena. "[Porcentaje de incremento anual: ".$this->getPorcIncAnual()."%]";
        $cadena = $cadena. "[Activa: ".$estadoActiva."]";

        return $cadena;
    }

    /**
     * Método darPrecioVenta el cual calcula el valor por el cual puede ser vendida una moto.
     * Si la moto no se encuentra disponible para la venta retorna un valor < 0. Si la moto está disponible para
     * la venta, el método realiza el siguiente cálculo:
     * $_enta = $_compra + $_compra * (anio * por_inc_anual)
     * donde $_compra: es el costo de la moto.
     * anio: cantidad de años transcurridos desde que se fabricó la moto.
     * por_inc_anual: porcentaje de incremento anual de la moto.
     * 
     * @return float $precioVenta
     */
    public function darPrecioVenta(){
        //float $precioVenta, $costoBase
        //int $aniosTranscurridos

        if($this->getActiva() == false){
            $precioVenta = -1;
        } else {
            $costoBase = $this->getCosto();
            $aniosTranscurridos = 2023 - $this->getAnioFabricacion();
            $precioVenta = $costoBase + ($costoBase * ($aniosTranscurridos * $this->getPorcIncAnual()));
        }

        return $precioVenta;
    }
}

?>
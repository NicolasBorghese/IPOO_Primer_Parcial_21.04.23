<?php

class Venta{

    //ATRIBUTOS
    private $numero;
    private $fecha;
    private $cliente;
    private $colMotos;
    private $precioFinal;

    //CONSTRUCTOR
    public function __construct($numero, $fecha, $cliente, $colMotos, $precioFinal){
        $this->numero = $numero;
        $this->fecha = $fecha;
        $this->cliente = $cliente;
        $this->colMotos = $colMotos;
        $this->precioFinal = $precioFinal;
    }

    //OBSERVADORES
    public function getNumero(){
        return $this->numero;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getCliente(){
        return $this->cliente;
    }

    public function getColMotos(){
        return $this->colMotos;
    }

    public function getPrecioFinal(){
        return $this->precioFinal;
    }

    //MODIFICADORES
    public function setNumero($numero){
        $this->numero = $numero;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function setColMotos($colMotos){
        $this->colMotos = $colMotos;
    }

    public function setPrecioFinal($precioFinal){
        $this->precioFinal = $precioFinal;
    }

    //PROPIOS DE CLASE
    /**
     * Devuelve una cadena con los valores de los atributos de la instancia actual de la clase Venta
     * 
     * @return string
     */
    public function __toString(){
        //string $cadena
        $cadena = "[Número venta: ".$this->getNumero()."]";
        $cadena = $cadena. "[Fecha: ".$this->getFecha()."]";
        $cadena = $cadena. "[Precio final: $".$this->getPrecioFinal()."]\n";
        $cadena = $cadena. "Cliente: ".$this->getCliente()."\n";
        $cadena = $cadena. " -- Colección de motos en la venta --\n".$this->mostrarColMotos();
        

        return $cadena;
    }

    /**
     * Metodo que retorna una variable de tipo string que contiene todas las motos de colMotos
     * 
     * @return string
     */
    public function mostrarColMotos(){
        //string $cadena
        //array $colMotos
        
        $cadena = "";
        $colMotos = $this->getColMotos();
        
        if (count($colMotos) == 0){
            $cadena = "[Esta venta no tiene motos incorporadas]\n";
        } else {
            for($i = 0; $i < count($colMotos); $i++){
                $cadena = $cadena ."Moto N° ". $i+1 .": ".$colMotos[$i]."\n";
            }
        }
        return $cadena;
    }

    /**
     * Método incorporarMoto($objMoto) que recibe por parámetro un objeto moto y lo
     * incorpora a la colección de motos de la venta, siempre y cuando sea posible la venta. El método cada
     * vez que incorpora una moto a la venta, debe actualizar la variable instancia precio final de la venta.
     * Uilizar el método que calcula el precio de venta de la moto donde crea necesario.
     * 
     * @param Moto
     */
    public function incorporarMoto($objMoto){
        //array $colMotosCopia
        //float $precioMoto, $precioFinalCopia

        if($objMoto->getActiva()){
            $colMotosCopia = $this->getColMotos();
            array_push($colMotosCopia, $objMoto);
            $this->setColMotos($colMotosCopia);

            $precioMoto = $objMoto->darPrecioVenta();
            $precioFinalCopia = $this->getPrecioFinal();
            $precioFinalCopia = $precioFinalCopia + $precioMoto;
            $this->setPrecioFinal($precioFinalCopia);
        }
    }

}

?>
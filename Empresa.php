<?php

include_once("Cliente.php");
include_once("Moto.php");
include_once("Venta.php");

class Empresa{
    
    //ATRIBUTOS
    private $denominacion;
    private $direccion;
    private $colClientes;
    private $colMotos;
    private $colVentas;

    //CONSTRUCTOR
    public function __construc($denominacion, $direccion, $colClientes, $colMotos, $colVentas){
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->colClientes = $colClientes;
        $this->colMotos = $colMotos;
        $this->colVentas = $colVentas;
    }

    //OBSERVADORES
    public function getDenominacion(){
        return $this->denominacion;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getColClientes(){
        return $this->colClientes;
    }

    public function getColMotos(){
        return $this->colMotos;
    }

    public function getColVentas(){
        return $this->colVentas;
    }

    //MODIFICADORES
    public function setDenominacion($denominacion){
        $this->denominacion = $denominacion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function setColClientes($colClientes){
        $this->colClientes = $colClientes;
    }

    public function setColMotos($colMotos){
        $this->colMotos = $colMotos;
    }

    public function setColVentas($colVentas){
        $this->colVentas = $colVentas;
    }

    //PROPIOS DE CLASE
    /**
     * Devuelve una cadena con los valores de los atributos de la instancia actual de la clase Empresa
     * 
     * @return string
     */
    public function __toString(){
        //string $cadena
        $cadena = "Denominación: ".$this->getDenominacion()."\n";
        $cadena = $cadena ."Dirección: ".$this->getDireccion()."\n";
        $cadena = $cadena ."Colección de clientes:\n".$this->colClientesAString()."\n";
        $cadena = $cadena ."Colección de motos:\n".$this->colMotosAString()."\n";
        $cadena = $cadena ."Colección de ventas:\n".$this->colVentasAString()."\n";

        return $cadena;
    }

    /**
     * Metodo que retorna una variable de tipo string que contiene todas los clientes de colClientes
     * 
     * @return string
     */
    public function colClientesAString(){
        //string $cadena
        //array $clientes
        
        $cadena = "";
        $clientes = $this->getColClientes();
        
        for($i = 0; $i < count($clientes); $i++){
            $cadena = $cadena ."Cliente n° [". $i . "]:\n".$clientes[$i]."\n---\n";
        }

        return $cadena;
    }
    
    /**
     * Metodo que retorna una variable de tipo string que contiene todas las motos de colMotos
     * 
     * @return string
     */
    public function colMotosAString(){
        //string $cadena
        //array $motos
        
        $cadena = "";
        $motos = $this->getColMotos();
        
        for($i = 0; $i < count($motos); $i++){
            $cadena = $cadena ."Moto n° [". $i . "]:\n".$motos[$i]."\n---\n";
        }

        return $cadena;
    }

    /**
     * Metodo que retorna una variable de tipo string que contiene todas las ventas de colVentas
     * 
     * @return string
     */
    public function colVentasAString(){
        //string $cadena
        //array $ventas
        
        $cadena = "";
        $ventas = $this->getColVentas();
        
        for($i = 0; $i < count($ventas); $i++){
            $cadena = $cadena ."Venta n° [". $i . "]:\n".$ventas[$i]."\n---\n";
        }

        return $cadena;
    }

    /**
     * Método retornarMoto($codigoMoto) que recorre la colección de motos de la Empresa y
     * retorna la referencia al objeto moto cuyo código coincide con el recibido por parámetro.
     * 
     * @param string $codigo
     */
    public function retornarMoto($codigoMoto){
        //boolean $motoEncontrada
        //int $posMoto
        //array $colMotosCopia
        //Moto $motoObtenida

        $motoObtenida = null;
        $motoEncontrada = false;
        $posMoto = 0;
        $colMotosCopia = $this->getColMotos();

        while($motoEncontrada == false && $posMoto < count($colMotosCopia)){
            if($colMotosCopia[$posMoto]->getCodigo() == $codigoMoto){
                $motoEncontrada = true;
                $motoObtenida = $colMotosCopia[$posMoto];
            }
            $posMoto++;
        }

        return $motoObtenida;
    }

    /**
     * método registrarVenta($colCodigosMoto, $objCliente) método que recibe por parámetro una colección de códigos de motos, la cual es recorrida, y por cada elemento de la colección
     * se busca el objeto moto correspondiente al código y se incorpora a la colección de motos de la instancia
     * Venta que debe ser creada. Recordar que no todos los clientes ni todas las motos, están disponibles
     * para registrar una venta en un momento determinado.
     * El método debe setear los variables instancias de venta que corresponda y retornar el importe final de la
     * venta.
     * 
     * @param array $colCodigosMoto
     * @param Cliente $objCliente
     * 
     * @return float
     */
    public function registrarVenta($colCodigosMoto, $objCliente){
        $importeFinal = 0;

        if($objCliente->getEstado() == "alta"){

            $motosAVender = [];

            $colMotos = $this->getColMotos();

            for($posCodigo = 0; $posCodigo < count($colCodigosMoto); $posCodigo++){

                $codigoActual = $colCodigosMoto[$posCodigo];
                $codigoEncontrado = false;
                $posMoto = 0;

                while($codigoEncontrado == false && $posMoto < count($colMotos)){
                    $motoActual = $colMotos[$posMoto];

                    if($motoActual->getActiva() && $motoActual->getCodigo() == $codigoActual){
                        array_push($motosAVender, $motoActual);
                        $importeFinal = $importeFinal + $motoActual->darPrecioVenta();
                    }
                }
            }

            $nuevaVenta = new Venta("1234", "21/04/23", $objCliente, $motosAVender, $importeFinal);
            $copiaColVentas = $this->getColVentas();
            array_push($copiaColVentas, $nuevaVenta);
            $this->setColVentas($nuevaVenta);

        } else {
            $importeFinal = -1;
        }

        return $importeFinal;
    }

    /**
     * método retornarVentasXCliente($tipo,$numDoc) que recibe por parámetro el tipo y
     * número de documento de un Cliente y retorna una colección con las ventas realizadas al cliente.
     * 
     * @param string $tipo
     * @param string $numDoc
     * 
     * @return array
     */
    public function retornarVentasXCliente($tipo, $numDoc){

        $colVentasCliente = [];
        for($i=0; $i < count($this->getColVentas()); $i++){
            if($this->getColVentas()[$i]->getCliente()->getTipoDocumento() == $tipo &&
            $this->getColVentas()[$i]->getCliente()->getNumeroDocumento() == $numDoc){
                array_push($colVentasCliente, $this->getColVentas()[$i]);
            }
        }

        return $colVentasCliente;
    }



}

?>
<?php

class Empresa{
    
    //ATRIBUTOS
    private $denominacion;
    private $direccion;
    private $colClientes;
    private $colMotos;
    private $colVentas;

    //CONSTRUCTOR
    public function __construct($denominacion, $direccion, $colClientes, $colMotos, $colVentas){
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
        $cadena = "================================================================================================\n";
        $cadena = $cadena. "Empresa: [Denominación: ".$this->getDenominacion()."]";
        $cadena = $cadena ."[Dirección: ".$this->getDireccion()."]\n\n";
        $cadena = $cadena ."--- Colección de clientes en empresa ---\n".$this->mostrarColClientes()."\n";
        $cadena = $cadena ."--- Colección de motos en empresa ---\n".$this->mostrarColMotos()."\n";
        $cadena = $cadena ."--- Colección de ventas en empresa ---\n".$this->mostrarColVentas();
        $cadena = $cadena ."================================================================================================\n";

        return $cadena;
    }

    /**
     * Metodo que retorna una variable de tipo string que contiene todas los clientes de colClientes
     * 
     * @return string
     */
    public function mostrarColClientes(){
        //string $cadena
        //array $colClientes
        
        $cadena = "";
        $colClientes = $this->getColClientes();
        
        if (count($colClientes) == 0){
            $cadena = "[Esta empresa no cuenta con clientes cargados]\n";
        } else {
            for($i = 0; $i < count($colClientes); $i++){
                $cadena = $cadena ."Cliente n° ". $i+1 .": ".$colClientes[$i]."\n";
            }
        }
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
        
        if(count($colMotos) == 0){
            $cadena = "[Esta empresa no cuenta con motos cargadas]\n";
        } else {
            for($i = 0; $i < count($colMotos); $i++){
                $cadena = $cadena ."Moto n° ". $i+1 .": ".$colMotos[$i]."\n";
            }
        }
        return $cadena;
    }

    /**
     * Metodo que retorna una variable de tipo string que contiene todas las ventas de colVentas
     * 
     * @return string
     */
    public function mostrarColVentas(){
        //string $cadena
        //array $colVentas
        
        $cadena = "";
        $colVentas = $this->getColVentas();
        
        if(count($colVentas) == 0){
            $cadena = "[Esta empresa no cuenta con ventas cargadas]\n";
        } else {
            for($i = 0; $i < count($colVentas); $i++){
                $cadena = $cadena ."Venta n° ". $i+1 . ": ".$colVentas[$i]."\n";
            }
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

            $codigoVenta = count($this->getColVentas())+1;
            $nuevaVenta = new Venta($codigoVenta, "21/04/23", $objCliente, [] , 0);

            for($i=0; $i < count($colCodigosMoto); $i++){

                $codigoActual = $colCodigosMoto[$i];
                $motoEncontrada = $this->retornarMoto($codigoActual);

                if($motoEncontrada != null && $motoEncontrada->getActiva()){
                    $nuevaVenta->incorporarMoto($motoEncontrada);
                }
            }

            $importeFinal = $nuevaVenta->getPrecioFinal();
            $copiaColVentas = $this->getColVentas();
            array_push($copiaColVentas, $nuevaVenta);
            $this->setColVentas($copiaColVentas);

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
        $colVentas = $this->getColVentas();

        for($i=0; $i < count($colVentas); $i++){
            $tipoDocLeido = $colVentas[$i]->getCliente()->getTipoDocumento();
            $numDocLeido = $colVentas[$i]->getCliente()->getNumeroDocumento();

            if($tipoDocLeido == $tipo && $numDocLeido == $numDoc){
                array_push($colVentasCliente, $colVentas[$i]);
            }
        }
        return $colVentasCliente;
    }



}

?>
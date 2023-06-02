<?php

include_once "Cliente.php";
include_once "Moto.php";
include_once "Venta.php";
include_once "Empresa.php";

// ----------------------- FUNCIONES ----------------------------//

/**
 * Recibe un arreglo y devuelve un string que muestra los elementos contenidos en ese arreglo
 * Observación: NO SIRVE PARA ARREGLOS DE ARREGLOS
 * 
 * @param array $arreglo
 * @return string
 */
function muestraArreglo($arreglo){
    $cadena = "";
    
    if(count($arreglo) == 0){
        $cadena = "[Esta colección no tiene elementos]\n";
    } else {
        for($i=0; $i < count($arreglo); $i++){
            $cadena = $cadena . "Elemento N°". $i+1 . ": ". $arreglo[$i] ."\n";
        }
    }
    return $cadena;
}

// ------------------ PROGRAMA PRINCIPAL -----------------------//

$objCliente1 = new Cliente("pedro", "Perez", "alta", "dni", "1122");
$objCliente2 = new Cliente("Marcos", "Fernandez", "alta", "dni", "1144");

$objMoto1 = new Moto(11, 2230000, 2022, "Benelli Imperiale 400", 85, true);
$objMoto2 = new Moto(12, 5840000, 2021, "Zanella Zr 150 Ohc", 70, true);
$objMoto3 = new Moto(13, 999900, 2023, "Zanella Patagonian Eagle 250", 55, false);

$colMotos = [$objMoto1, $objMoto2, $objMoto3];
$colClientes = [$objCliente1, $objCliente2];

$objEmpresa1 = new Empresa("Alta gama", "Av Argentina 123", $colClientes, $colMotos, []);

echo"\n";
echo"Estado Inicial de la empresa\n";
echo $objEmpresa1;
echo"\n";
echo "Valor final de precio al registarVenta([11,12,13], objCliente2)\n";
echo "$".$objEmpresa1->registrarVenta([11,12,13], $objCliente2)."\n";
echo"\n";
echo "Valor final de precio al registarVenta([0], objCliente2)\n";
echo "$".$objEmpresa1->registrarVenta([0], $objCliente2)."\n";
echo"\n";
echo "Valor final de precio al registarVenta([2], objCliente2)\n";
echo "$".$objEmpresa1->registrarVenta([2], $objCliente2)."\n";
echo"\n";
echo"Colección de ventas al hacer retornarVentasXCliente(dni, 1122)\n";
echo muestraArreglo($objEmpresa1->retornarVentasXCliente("dni", "1122"))."\n";
echo"\n";
echo"Colección de ventas al hacer retornarVentasXCliente(dni, 1144)\n";
echo muestraArreglo($objEmpresa1->retornarVentasXCliente("dni", "1144"))."\n";
echo"\n";
echo"Estado Final de la empresa\n";
echo $objEmpresa1;
echo"\n";

?>
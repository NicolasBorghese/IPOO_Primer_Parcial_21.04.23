<?php

include_once "Cliente.php";
include_once "Moto.php";
include_once "Venta.php";
include_once "Empresa.php";


$objCliente1 = new Cliente("pedro", "jose", "alta", "dni", "1122");
$objCliente2 = new Cliente("Marcos", "jose", "alta", "dni", "1142");

$objMoto1 = new Moto(11, 2230000, 2022, "Benelli Imperiale 400", 85, true);
$objMoto2 = new Moto(12, 5840000, 2021, "Zanella Zr 150 Ohc", 70, true);
$objMoto3 = new Moto(13, 999900, 2023, "Zanella Patagonian Eagle 250", 55, false);

$colMotos = [$objMoto1, $objMoto2, $objMoto3];
$colClientes = [$objCliente1, $objCliente2];

$objEmpresa1 = new Empresa("Alta gama", "Av Argenetina 123", $colClientes, $colMotos, []);

echo"\n";
echo $objEmpresa1;
echo"\n";
echo $objEmpresa1->registrarVenta([11,12,13], $objCliente2);
echo"\n";
echo $objEmpresa1->registrarVenta([0], $objCliente2);
echo"\n";
echo $objEmpresa1->registrarVenta([2], $objCliente2);
echo"\n";
print_r ($objEmpresa1->retornarVentasXCliente("dni", "1122"));
echo"\n";
print_r ($objEmpresa1->retornarVentasXCliente("dni", "1142"));
echo"\n";
echo $objEmpresa1;
echo"\n";

?>
<?php
include_once ('EmpresaCable.php');
include_once ('Contrato.php');
include_once ('ContratoViaWeb.php');
include_once ('Canal.php');
include_once ('Plan.php');
include_once ('Cliente.php');
//EJERCICIO 7
//EJERCICIO A
$objEmpresaCable = new EmpresaCable([],[]);

//EJERCICIO B
$objCanal1 = new Canal('DEPORTIVO', 100, true);
$objCanal2 = new Canal('MUSICAL', 50, false);
$objCanal3 = new Canal('PELICULAS', 55, true);

$colCanales1 = [$objCanal1, $objCanal2];
$colCanales2 = [$objCanal1, $objCanal3];

//EJERCICIO C
$objPlan1 = new Plan(111, $colCanales1, 300, 50);
$objPlan2 = new Plan(112, $colCanales2, 500, 50);

//EJERCICIO D
$objCliente = new Cliente('Emanuel Pinedo', "20-45798194-6", "300 Viviendas Tira I Modulo 25");


//EJERCICIO E
$contratoEmpresa = new Contrato('12-6-2024', '27-8-2024',$objPlan1, 500, true, $objCliente);
$contratoWeb = new Contrato('14-6-2024', '29-8-2024', $objPlan2, 300, false, $objCliente);
$contratoWeb2 = new Contrato ('13-6-2024', '30-8-2024', $objPlan1, 200, true, $objCliente);

//EJERCICIO F
echo "EL IMPORTE DE EMPRESA ES: " . $contratoEmpresa->calcularImporte() . "\n";
echo "EL IMPORTE DE EMPRESA VIA WEB ES: " . $contratoWeb->calcularImporte() . "\n";
echo "EL IMPORTE DE EMPRESA VIA WEB ES: " . $contratoWeb2->calcularImporte() . "\n";

//EJERCICIO G
$objEmpresaCable->incorporarPlan($objPlan1);

//EJERCICIO H
$objEmpresaCable->incorporarPlan($objPlan2);

//EJERCICIO I y J
$fechaInicio = new DateTime();//FECHA INICIO ACTUAL
$fechaVencimiento = (clone $fechaInicio)->modify('+30 days');//FECHA EN 30 DIAS

$contratoEmpresa = $objEmpresaCable->incorporarContrato($objPlan1, $objCliente, $fechaInicio, $fechaVencimiento, false);
$contratoWeb = $objEmpresaCable->incorporarContrato($objPlan2, $objCliente, $fechaInicio, $fechaVencimiento, true);
$contratoWeb2 = $objEmpresaCable->incorporarContrato($objPlan1, $objCliente, $fechaInicio, $fechaVencimiento, true);

//EJERCICIO K
echo "PAGAR CONTRATO: " . $objEmpresaCable->pagarContrato($contratoEmpresa) . "\n";

//EJERCICIO L
echo "PAGAR CONTRATO: " .$objEmpresaCable->pagarContrato($contratoWeb) . "\n";

//EJERCICIO M
echo "IMPORTE CONTRATOS: " . $objEmpresaCable->retornarImporteContratos(111) . "\n";

echo $objEmpresaCable;
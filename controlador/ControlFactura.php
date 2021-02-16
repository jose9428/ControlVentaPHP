<?php

require_once '../modelo/FacturaDAO.php';

$obj = new FacturaDAO;

$accion = $_REQUEST["accion"];

if ($accion === "listar") {
    header("location: ./../vista/ListarMisVentas.php");
} else if ($accion == "verDetalle") {
    $nro_factura = $_REQUEST["nro_factura"];
    $data = $obj->getDetalle($nro_factura);
    echo json_encode($data);
}else if ($accion === "consultarFechas") {
     $fechaInicio = $_REQUEST["fechaInicio"];
     $fechaFin = $_REQUEST["fechaFin"];
     
     header("location: ./../vista/ListaConsulta.php?fechaInicio=".$fechaInicio."&fechaFin=".$fechaFin);
}
?>

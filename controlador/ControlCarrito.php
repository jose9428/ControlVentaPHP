<?php

session_start();

require_once '../modelo/ProductoDAO.php';
require_once '../modelo/FacturaDAO.php';

$objProd = new ProductoDAO();
$objFactura = new FacturaDAO();

$accion = $_REQUEST["accion"];

$carrito = array();
if (isset($_SESSION["canasta"])) {
    $carrito = $_SESSION["canasta"];
}

if ($accion === "listar") {
    header("location: ./../vista/ListaCarrito.php");
} else if ($accion === "agregar") {
    $codigo = $_REQUEST["codigo_act"];
    $nombre = $_REQUEST["nombre_act"];
    $cantidad = $_REQUEST["cantidad"];
    $precio = $_REQUEST["precio_venta_act"];
    $precio_compra_act = $_REQUEST["precio_compra_act"];

    $data = $objProd->BuscarPorId($codigo); // Buscar producto

    $total = TotalAcumulado($carrito, $codigo);

    if ($data[0]["cantidad"] < ($total + $cantidad)) {
        $cantidad = $data[0]["cantidad"] - $total;
    }

    if ($cantidad <= 0) {
        echo "No se ha podido agregar, stock insuficiente";
    } else {
        $encontro = false;
        foreach ($carrito as $indice => $producto) {
            if ($producto[0] == $codigo && $precio == $data[0][3] && $precio == $producto[3]) {
                // precio venta
                $producto[2] = $producto[2] + $cantidad;
                $carrito[$indice] = $producto;
                $encontro = true;
            }

            if ($producto[0] == $codigo && $precio == $data[0][4]&& $precio == $producto[3]) {
                // Precio Oferta
                $producto[2] = $producto[2] + $cantidad;
                $carrito[$indice] = $producto;
                $encontro = true;
            }
        }

        if ($encontro == false) {
            $cp = array($codigo, $nombre, $cantidad, $precio, $precio_compra_act);
            $carrito[] = $cp; // Agregando
        }

        $_SESSION["canasta"] = $carrito;

        echo "OK";
    }
} else if ($accion === "agregar3") {
    $codigo = $_REQUEST["codigo_act"];
    $nombre = $_REQUEST["nombre_act"];
    $cantidad = $_REQUEST["cantidad"];
    $precio = $_REQUEST["precio_venta_act"];
    $precio_compra_act = $_REQUEST["precio_compra_act"];

    $data = $objProd->BuscarPorId($codigo); // Buscar producto

    $total = TotalAcumulado($carrito, $codigo);

    if ($data[0]["cantidad"] < ($total + $cantidad)) {
        $cantidad = $data[0]["cantidad"] - $total;
    }

    if ($cantidad <= 0) {
        echo "No se ha podido agregar, stock insuficiente";
    } else {
        $cp = array($codigo, $nombre, $cantidad, $precio, $precio_compra_act);

        $carrito[] = $cp; // Agregando

        $_SESSION["canasta"] = $carrito;

        echo "OK";
    }
} else if ($accion === "agregar2") {
    $codigo = $_REQUEST["codigo_act"];
    $nombre = $_REQUEST["nombre_act"];
    $cantidad = $_REQUEST["cantidad"];
    $precio = $_REQUEST["precio_venta_act"];
    $precio_compra_act = $_REQUEST["precio_compra_act"];

    $data = $objProd->BuscarPorId($codigo); // Buscar producto
    $cp = array($codigo, $nombre, $cantidad, $precio, $precio_compra_act);
    $encontro = false;

    foreach ($carrito as $indice => $producto) {
        if ($producto[0] == $codigo) {

            $producto[2] = $producto[2] + $cantidad; // actualizo el stock

            if ($data[0]["cantidad"] < $producto[2]) {
                $producto[2] = $data[0]["cantidad"];
            }

            $carrito[$indice] = $producto;
            $encontro = true;
            break;
        }
    }

    if ($encontro == false) {
        $carrito[] = $cp; // Agregando
    }

    $_SESSION["canasta"] = $carrito;

    echo "OK";
} else if ($accion === "anular") {

    $indice = $_REQUEST["key"];

    unset($carrito[$indice]);
    $_SESSION["canasta"] = $carrito;
} else if ($accion === "procesar_compra") {
    $cliente = $_REQUEST["cliente"];
    $vendedor = $_SESSION["usuario"][0][4]; // nombre de la persona

    $total = 0;
    foreach ($carrito as $indice => $producto) {
        $total += ($producto[2] * $producto[3]);
    }

    $nrofactura = $objFactura->RegistrarFactura($cliente, $total, $vendedor);

    if ($nrofactura > 0) {
        foreach ($carrito as $indice => $producto) {
            $cod_producto = $producto[0];
            $nom_producto = $producto[1];
            $cantidad = $producto[2];
            $p_venta = $producto[3];
            $p_compra = $producto[4];

            $objFactura->RegistrarDetalle($nrofactura, $cod_producto, $nom_producto, $cantidad, $p_compra, $p_venta);
        }

        unset($_SESSION['canasta']); // Borrar Sesion del carrito
    }

    echo $nrofactura;
}

function TotalAcumulado($carrito, $codigo) {
    $total = 0;
    foreach ($carrito as $indice => $producto) {
        if ($producto[0] == $codigo) {
            $total+= $producto[2];
        }
    }
    return $total;
}

?>
<?php

require_once '../modelo/ProductoDAO.php';

$obj = new ProductoDAO();

$accion = $_REQUEST["accion"];

if ($accion === "listar") {
    header("location: ./../vista/ListarProductos.php");
} else if ($accion === "guardar") {
    $nombre = $_POST["nombre"];
    $compra = $_POST["precio_compra"];
    $venta = $_POST["precio_venta"];
    $oferta = (!empty($_POST["precio_oferta"]) ? $_POST["precio_oferta"] : null );
    $cantidad = $_POST["cantidad"];
    $fecha = $_POST["fecha_vencimiento"];

    $data = $obj->BuscarPorNombre($nombre);

    if (count($data) > 0) {
        echo "Producto " . $nombre . " ya se encuentra registrado,intente con otro producto";
    } else {
        $data = $obj->Registrar($nombre, $compra, $venta, $oferta, $cantidad, $fecha);
        if ($data > 0) {
            echo "OK";
        } else {
            echo "No se ha podido procesar la informacion, ha ocurrido un error.";
        }
    }
} else if ($accion == "buscarPorId") {
    $id = $_REQUEST["id"];
    $data = $obj->BuscarPorId($id);
    echo json_encode($data);
} else if ($accion === "actualizar") {
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $compra = $_POST["precio_compra"];
    $venta = $_POST["precio_venta"];
    $oferta = (!empty($_POST["precio_oferta"]) ? $_POST["precio_oferta"] : null );
    $cantidad = $_POST["cantidad"];
    $fecha = $_POST["fecha_vencimiento"];

    $data = $obj->BuscarPorIdYNombre($codigo, $nombre);

    if (count($data)) {
        echo "Ya se encuentra registrado el producto " . $nombre . ". Intente con otro nombre para el producto";
    } else {
        $data = $obj->Actualizar($codigo, $nombre, $compra, $venta, $oferta, $cantidad, $fecha);

        if ($data) {
            echo "OK";
        } else {
            echo "No se ha podido procesar la informacion, ha ocurrido un error.";
        }
    }
} else if ($accion == "eliminar") {
    $id = $_REQUEST["id"];
    $res = $obj->Eliminar($id);
    echo $res;
} else if ($accion === "filtroLista") {
    $termino = $_REQUEST["search"];
    $data = $obj->getListadoFiltro($termino);

    if ($data) {
        foreach ($data as $row) {
            echo '<a href="#" class="list-group-item list-group-item-action border-1">' . $row[1] . '</a>';
        }
    } else {
        echo '<p class="list-group-item border-1">No se encontraron registros</p>';
    }
} else if ($accion === "filtroListaJson") {
    $termino = $_REQUEST["search"];
    $data = $obj->getListadoFiltro($termino);

    $aux = array();
    if ($data) {
        foreach ($data as $row) {
            $aux[] = $row[1];
        }
    }

    echo json_encode($aux);
} else if ($accion === "filtroListaJson2") {
    $termino = $_REQUEST["search"];
    $data = $obj->getListadoFiltro($termino);

    echo json_encode($data);
}
?>
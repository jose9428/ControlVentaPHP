<?php

require_once '../database/Conexion.php';

class ProductoDAO {

    function getListado() {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Producto";

        $sql = $conectar->prepare($sql);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function Registrar($nombre, $compra, $venta, $oferta, $cantidad, $fecha) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "insert into Producto values(null,?,?,?,?,?,?)";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $compra);
        $sql->bindValue(3, $venta);
        $sql->bindValue(4, $oferta);
        $sql->bindValue(5, $cantidad);
        $sql->bindValue(6, $fecha);
        $sql->execute();

        $id = $conectar->lastInsertId();

        return $id;
    }

    public function Eliminar($id) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "delete from Producto where id_prod=?";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();

        return $sql->rowCount();
    }

    public function BuscarPorId($id) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Producto where id_prod=?";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $id);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function Actualizar($codigo, $nombre, $compra, $venta, $oferta, $cantidad, $fecha) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "update Producto set nombre_prod =? , precio_compra = ? , precio_venta = ? , precio_oferta = ? "
                . " , cantidad = ? , fecha_vencimiento = ? where id_prod = ?";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $compra);
        $sql->bindValue(3, $venta);
        $sql->bindValue(4, $oferta);
        $sql->bindValue(5, $cantidad);
        $sql->bindValue(6, $fecha);
        $sql->bindValue(7, $codigo);
        return $sql->execute();
    }

    function getListadoFiltro($termino) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Producto where nombre_prod like '%" . $termino . "%'";

        $sql = $conectar->prepare($sql);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function BuscarPorNombre($nombre) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Producto where nombre_prod=?";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $nombre);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function BuscarPorIdYNombre($id, $nombre) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Producto where id_prod !=? and nombre_prod =?";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $id);
        $sql->bindValue(2, $nombre);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

}

?>
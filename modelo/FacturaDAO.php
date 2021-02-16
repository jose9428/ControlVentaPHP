<?php

require_once '../database/Conexion.php';

class FacturaDAO {

    public function RegistrarFactura($cliente, $total,$vendedor) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "insert into Factura values(null,?,now(),?,?)";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $cliente);
        $sql->bindValue(2, $total);
        $sql->bindValue(3, $vendedor);
        $sql->execute();

        $id = $conectar->lastInsertId();

        return $id;
    }

    public function RegistrarDetalle($nro_factura, $cod_producto, $nom_producto, $cantidad, $p_compra, $p_venta) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "call SPdetalle(?,?,?,?,?,?)";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $nro_factura);
        $sql->bindValue(2, $cod_producto);
        $sql->bindValue(3, $nom_producto);
        $sql->bindValue(4, $cantidad);
        $sql->bindValue(5, $p_compra);
        $sql->bindValue(6, $p_venta);
        $sql->execute();

        $id = $conectar->lastInsertId();

        return $id;
    }

    function getListado() {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Factura";

        $sql = $conectar->prepare($sql);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    function getDetalle($nro_factura) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Detalle_Factura where nro_factura = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nro_factura);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    function BuscarPorFechas($inicio, $fin) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select DATE_FORMAT(fecha_venta,'%d/%m/%Y') , nombre_prod , cantidad_adquirida , (precio_compra * cantidad_adquirida) , 
             (precio_venta * cantidad_adquirida) , (ganancia * cantidad_adquirida) , cliente ,id_prod , vendedor
              from Detalle_Factura d inner join factura f 
               on d.nro_factura = f.nro_factura where DATE_FORMAT(fecha_venta,'%Y-%m-%d') between ? and ?";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $inicio);
        $sql->bindValue(2, $fin);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

}

?>
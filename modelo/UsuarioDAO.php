<?php

require_once '../database/Conexion.php';

class UsuarioDAO {

    public function BuscarUsuario($user, $pass) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Usuario where username=? and pass=? and estado = 1";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $user);
        $sql->bindValue(2, $pass);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    function getListado() {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Usuario";

        $sql = $conectar->prepare($sql);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function Registrar($nombre, $usuario, $pass, $rol) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "insert into Usuario (nombre , username,pass,rol,estado) values(?,?,?,?,1)";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $usuario);
        $sql->bindValue(3, $pass);
        $sql->bindValue(4, $rol);
        $sql->execute();

        $id = $conectar->lastInsertId();

        return $id;
    }

    public function BuscarExistenciaUsuario($user) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Usuario where username=?";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $user);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function Eliminar($id) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "delete from Usuario where id_usuario=?";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();

        return $sql->rowCount();
    }

    public function BuscarPorId($id) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Usuario where id_usuario=?";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $id);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function Actualizar($codigo, $nombre, $usuario, $pass, $rol, $estado) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "update Usuario set username =? , pass = ? , rol = ? , nombre = ? "
                . " , estado = ?  where id_usuario = ?";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $usuario);
        $sql->bindValue(2, $pass);
        $sql->bindValue(3, $rol);
        $sql->bindValue(4, $nombre);
        $sql->bindValue(5, $estado);
        $sql->bindValue(6, $codigo);
        return $sql->execute();
    }

    public function BuscarPorIdYNombre($id, $username) {
        $cn = new Conexion();
        $conectar = $cn->getConexion();
        $cn->set_names();

        $sql = "select * from Usuario where id_usuario!=? and username =?";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $id);
        $sql->bindValue(2, $username);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

}

?>

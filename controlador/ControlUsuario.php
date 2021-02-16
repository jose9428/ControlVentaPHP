
<?php

require_once '../modelo/UsuarioDAO.php';

session_start();

$obj = new UsuarioDAO();

$accion = $_REQUEST["accion"];

if ($accion === "iniciar") {
    $username = $_POST["username"];
    $pass = $_POST["pass"];

    $data = $obj->BuscarUsuario($username, $pass);

    if (count($data) > 0) {
      
        $_SESSION["usuario"] = $data;
        header("location: ./../PagMisVentas.php");
    } else {

        $_SESSION["error"] = 1;

        header("location: ./../index.php");
    }
} else if ($accion === "cerrar") {

    unset($_SESSION['usuario']);
    header("location: ./../index.php");
} else if ($accion === "listar") {
    header("location: ./../vista/ListarUsuarios.php");
} else if ($accion === "guardar") {
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $pass = $_POST["pass"];
    $rol = $_POST["rol"];

    $existencia = $obj->BuscarExistenciaUsuario($usuario);

    if (count($existencia) > 0) {
        echo "El usuario " . $usuario . " ya se encuentra registrado, intente con otro usuario";
    } else {
        $data = $obj->Registrar($nombre, $usuario, $pass, $rol);
        if ($data > 0) {
            echo "OK";
        } else {
            echo "No se ha podido registrar usuario";
        }
    }
} else if ($accion == "eliminar") {
    $id = $_REQUEST["id"];
    $res = $obj->Eliminar($id);
    echo $res;
} else if ($accion == "buscarPorId") {
    $id = $_REQUEST["id"];
    $data = $obj->BuscarPorId($id);
    echo json_encode($data);
} else if ($accion === "actualizar") {
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $pass = $_POST["pass"];
    $rol = $_POST["rol"];
    $estado = $_POST["estado"];

    $data = $obj->BuscarPorIdYNombre($codigo, $usuario);

    if (count($data)) {
        echo "El usuario " . $usuario . " ya se encuentra registrado. Intente con otro nombre de usuario";
    } else {
        $data = $obj->Actualizar($codigo, $nombre, $usuario, $pass, $rol, $estado);

        if ($data) {
            echo "OK";
        } else {
            echo "No se ha podido actualizar el usuario, ha ocurrido un error.";
        }
    }
}
?>
